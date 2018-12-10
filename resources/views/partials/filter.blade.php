<div id="masterFilter">

    <div class="widget list categories clear">
        <h4><i class="icon-tasks"></i> &nbsp;Catégories</h4>
        @if(!empty($categories))
            <select id="arret-chosen" name="category_check" data-placeholder="Choisir une ou plusieurs catégories" style="width:100%" multiple class="chosen-select category">
                @foreach($categories as $categorie)
                    <option value="c{{ $categorie->id }}">{{ $categorie->title }}</option>
                @endforeach
            </select>
        @endif
    </div><!--END WIDGET-->
    <div class="widget list annees clear">
        <h4><i class="icon-calendar"></i> &nbsp;Années</h4>
        @if(!empty($annees))
            <ul id="arret-annees" class="list annees clear">
                @foreach($annees as $annee)
                    <li><a rel="y{{ $annee }}" href="#">Paru en {{ $annee }}</a></li>
                @endforeach
            </ul>
        @endif
    </div><!--END WIDGET-->

</div><!--END SIDEBAR-->

