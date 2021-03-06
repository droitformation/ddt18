<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SendMessageRequest;
use mysql_xdevapi\Collection;

class HomeController extends Controller
{
    protected $pages;
    protected $content;
    protected $jurisprudence;
    protected $worker;

    public function __construct()
    {
        $this->content  = new \App\Droit\Api\Content(config('app.site'));
        $this->jurisprudence = new \App\Droit\Api\Jurisprudence(config('app.site'));
        $this->worker = new \App\Droit\Api\ColloqueWorker();

        $menu   = $this->content->menu('main');
        $latest = $this->jurisprudence->arrets(['limit' => 4],'latest');

        view()->share('latest', $latest);
        view()->share('menu', $menu);

        $this->pages = isset($menu->pages) ? collect($menu->pages)->pluck('id','slug')->all() : collect([]);

        setlocale(LC_ALL, 'fr_FR.UTF-8');
    }

    /**
     * Homepage
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homepage = $this->content->homepage();
        $page     = $this->content->page($this->pages['/']);
        $pub      = isset($page->blocs) ? $page->blocs : collect([]);
        $arrets   = $this->jurisprudence->arrets(['limit' => 5],'index');

        return view('frontend.index')->with(['homepage' => $homepage, 'arrets' => $arrets, 'pub' => $pub]);
    }

    /**
     * Authors page
     *
     * @return \Illuminate\Http\Response
     */
    public function auteur()
    {
        $auteurs = $this->jurisprudence->authors();
        $page    = $this->content->page($this->pages['auteur']);
        $pub     = isset($page->blocs) ? $page->blocs : collect([]);

        return view('frontend.auteur')->with(['auteurs' => $auteurs, 'page' => $page, 'pub' => $pub]);
    }

    public function colloque()
    {
        $colloques = $this->worker->getColloques();
        $archives  = $this->worker->getArchives();

        $page = $this->content->page($this->pages['colloque']);
        $pub  = isset($page->blocs) ? $page->blocs : collect([]);

        return view('frontend.colloque')->with(array('colloques' => $colloques, 'archives' => $archives , 'pub' => $pub));
    }

    public function jurisprudence(Request $request)
    {
        $arrets     = $this->jurisprudence->arrets();
        $analyses   = $this->jurisprudence->analyses();
        $years      = $this->jurisprudence->years();

        list($categories,$parents) = $this->jurisprudence->categories();

        return view('frontend.jurisprudence')->with([
            'arrets'     => $arrets,
            'analyses'   => $analyses,
            'annees'     => $years,
            'categories' => $categories,
            'parents'    => $parents->pluck('title','id')->all(),
        ]);
    }

    public function campagne($id = null)
    {
        $newsletter = $this->jurisprudence->campagne($id);

        $blocs    = isset($newsletter['blocs']) ? $newsletter['blocs'] : collect([]);
        $campagne = isset($newsletter['campagne']) ? $newsletter['campagne'] : null;

        return view('frontend.campagne')->with(['campagne' => $campagne, 'blocs' => $blocs, 'archives' => collect([])]);
    }

    /**
     * Contact form
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        $page = $this->content->page($this->pages['contact']);
        $pub  = isset($page->blocs) ? $page->blocs : collect([]);

        return view('frontend.contact')->with(['page' => $page, 'pub' => $pub]);
    }

    /**
     * Contact form
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        $archives = $this->jurisprudence->archives();

        return view('frontend.archive')->with(['archives' => $archives]);
    }

    /**
     * Send contact message
     *
     * @return Response
     */
    public function sendMessage(SendMessageRequest $request)
    {
        $data = $request->only(['email','nom','remarque']);

        \Mail::send('emails.contact', $data , function($message) {
            $message->to('info@droitdutravail.ch', 'Droit du travail')->subject('Message depuis le site www.droitdutravail.ch');
        });

        return redirect()->back()->with(['status' => 'success', 'message' => '<strong>Merci pour votre message</strong><br/>Nous vous contacterons dès que possible.']);
    }

    public function pdf($id)
    {
        $environment = app()->environment();
        $base = ($environment == 'local' ? 'https://shop.local/' : 'https://www.publications-droit.ch/');
        $url  = $base.'hub/pdf/'.$id.'/'.env('APP_SITE');

        return redirect($url);
    }

    public function updateCache()
    {
        dispatch(function () {
            \Artisan::call('cache:clear');
        });
    }

}
