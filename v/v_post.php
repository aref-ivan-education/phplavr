<section class="s-content s-content--single">
    <div class="row">
        <div class="column large-12">

            <article class="s-post entry format-standard">

                <div class="s-content__media">
                    <div class="s-content__post-thumb">
                        <img src="images/thumbs/single/standard/standard-1050.jpg" 
                                srcset="images/thumbs/single/standard/standard-2100.jpg 2100w, 
                                        images/thumbs/single/standard/standard-1050.jpg 1050w, 
                                        images/thumbs/single/standard/standard-525.jpg 525w" sizes="(max-width: 2100px) 100vw, 2100px" alt="">
                    </div>
                </div> <!-- end s-content__media -->

                <div class="s-content__primary">

                    <h2 class="s-content__title s-content__title--post"><?=$article['title']?></h2>

                    <ul class="s-content__post-meta">
                        <li class="date"><?=$article['date']?></li>
                        <li class="cat"><a href=""><?=$article['category']?></a></li>
                    </ul>

                    <p class="lead">
                        <?=$article['content']?>
                    </p>

                    <p class="s-content__post-tags">
                        <span>Tagged in :</span>
                        <a href="#">orci</a><a href="#">lectus</a><a href="#">varius</a><a href="#">turpis</a>
                    </p>

                    <div class="s-content__author">
                        <img src="/assets/images/avatars/user-06.jpg" alt="">

                        <div class="about">
                            <h5><a href="#"><?=$article['user']?></a></h5>

            </article>



        </div> <!-- end column -->
        
    </div> <!-- end row -->
</section> <!-- end s-content -->
<?if($isAuth):?>
    <div class="row">
        <div class="column large-4 align-center">                   
            <a class="btn btn--primary h-full-width" href="/edit/<?=$article['id_article']?>">Редактировать</a>
        </div>
        <div class="column large-4 align-center">                   
            <a class="btn btn--primary h-full-width" href="/delete/<?=$article['id_article']?>">Удалить</a>
        </div>
    </div>
<?endif?>