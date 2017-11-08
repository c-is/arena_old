<?php
/**
 * The home template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package WordPress
 * @subpackage arena CUSTOM ORDER
 * @since 1.0
 * @version 1.0
 */
  
  
  get_header(); 
  
  //var_dump(get_categories('get=all'));
  
?>
  
  <div class="container" id="container">
    <main class="main main--home" id="main" role="main">
      <article class="content content--home" id="content">
        <nav class="content-navigation">
          <ul class="clear">
            <li class="active"><span>種類を選ぶ</span></li>
            <li><span>カスタムする</span></li>
            <li><span>オーダーする</span></li>
          </ul>
        </nav>
        <section class="section section--top js-get-height">
          <div class="menu-door menu-door--swimwear">
            <div class="menu-door__inner u-center-vertical">
              <a class="menu-door__link js-scroll-link" href="#item-swimwear"></a>
              <h2 class="menu-door__title"><img src="/simulation/assets/images/common/text-swimwear.png" alt="SWIMWEAR"></h2>
              <p class="menu-door__desc u-pc"><?php echo get_term_by('slug', 'swimwear', 'category')->description; ?></p>
              <div class="menu-door__desc u-sp">種類を選ぶ</div>
            </div>
            <div class="menu-door__bg"></div>
          </div>
          <div class="menu-door menu-door--teamwear">
            <div class="menu-door__inner u-center-vertical">
              <a class="menu-door__link js-scroll-link" href="#item-teamwear"></a>
              <h2 class="menu-door__title"><img src="/simulation/assets/images/common/text-teamwear.png" alt="TEAMWEAR"></h2>
              <p class="menu-door__desc u-pc"><?php echo get_term_by('slug', 'teamwear', 'category')->description; ?></p>
              <div class="menu-door__desc u-sp">種類を選ぶ</div>
            </div>
            <div class="menu-door__bg"></div>
          </div>
        </section>

        <!-- // SWIMWEAR -->
        <section class="section section--swimwear" id="item-swimwear">
          
          <header class="item-head item-head--swimwear">
            <div class="u-inner">
              <h2 class="item-head__title"><img src="/simulation/assets/images/common/text-swimwear.png" alt="SWIMWEAR"></h2>
              <p class="item-head__desc"><?php echo get_term_by('slug', 'swimwear', 'category')->description; ?></p>
            </div>
          </header>
          
          <!-- // Aquaforce Fusion-2 -->
          <?php $cat = get_term_by('slug', 'aquaforce-fusion-2', 'category'); ?>
          <div id="<?php echo $cat->slug; ?>" class="item-inner">
            <div class="u-inner">
              <article class="item-collection">
                <h3 class="item-collection__title"><img src="/simulation/assets/images/common/text-aquaforce.png" alt="AQUAFORCE FUSION"><i class="icon icon--fina"><img src="/simulation/assets/images/icons/icon-fina.png" alt="FINA承認モデル"></i></h3>
                <p class="item-collection__desc"><?php echo $cat->description; ?></p>
                <ul class="item-list clear">
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK02'), get_permalink(26)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-aquaforce1.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Women’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK02'), get_permalink(30)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-aquaforce2.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Men’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK02'), get_permalink(28)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-aquaforce3.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Girl’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK02'), get_permalink(32)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-aquaforce4.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Boy’s</span></div>
                  </li>
                </ul>
              </article>
            </div>
          </div>

          <!-- // X Python 2 -->
          <?php $cat = get_term_by('slug', 'x-python-2', 'category'); ?>
          <div id="<?php echo $cat->slug; ?>" class="item-inner">
            <div class="u-inner">
              <article class="item-collection">
                <h3 class="item-collection__title"><img src="/simulation/assets/images/common/text-x-python.png" alt="X-Python"><i class="icon icon--fina"><img src="/simulation/assets/images/icons/icon-fina.png" alt="FINA承認モデル"></i></h3>
                <p class="item-collection__desc"><?php echo $cat->description; ?></p>
                <ul class="item-list clear">
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK03'), get_permalink(34)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-x-python1.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Women’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK03'), get_permalink(42)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-x-python2.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Men’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK03'), get_permalink(36)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-x-python3.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Girl’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK03'), get_permalink(44)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-x-python4.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Boy’s</span></div>
                  </li>
                </ul>
              </article>
            </div>
          </div>

          <!-- // Urokoskin ST -->
          <?php $cat = get_term_by('slug', 'urokoskin-st', 'category'); ?>
          <div id="<?php echo $cat->slug; ?>" class="item-inner">
            <div class="u-inner">
              <article class="item-collection">
                <h3 class="item-collection__title"><img src="/simulation/assets/images/common/text-uroko-skin.png" alt="UROKO SKIN"><i class="icon icon--fina"><img src="/simulation/assets/images/icons/icon-fina.png" alt="FINA承認モデル"></i></h3>
                <p class="item-collection__desc"><?php echo $cat->description; ?></p>
                <ul class="item-list clear">
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK01'), get_permalink(50)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-uroko-skin1.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Women’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK01'), get_permalink(58)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-uroko-skin2.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Men’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK01'), get_permalink(52)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-uroko-skin3.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Girl’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK01'), get_permalink(60)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-uroko-skin4.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Boy’s</span></div>
                  </li>
                </ul>
              </article>
            </div>
          </div>

          <!-- // TOUGH SUIT -->
          <?php $cat = get_term_by('slug', 'tough-suit', 'category'); ?>
          <div id="<?php echo $cat->slug; ?>" class="item-inner">
            <div class="u-inner">
              <article class="item-collection">
                <h3 class="item-collection__title"><img src="/simulation/assets/images/common/text-tough-suit.png" alt="Tought suit"></h3>
                <p class="item-collection__desc"><?php echo $cat->description; ?></p>
                <ul class="item-list clear">
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK05'), get_permalink(62)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-tough-suit1.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Women’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK05'), get_permalink(70)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-tough-suit2.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Men’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK05'), get_permalink(66)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-tough-suit3.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Girl’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK05'), get_permalink(74)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-tough-suit4.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Boy’s</span></div>
                  </li>
                </ul>
              </article>
            </div>
          </div>
        </section>

        <!-- // TEAMWEAR -->
        <section class="section section--teamwear" id="item-teamwear">
          
          <header class="item-head item-head--teamwear">
            <div class="u-inner">
              <h2 class="item-head__title"><img src="/simulation/assets/images/common/text-teamwear.png" alt="TEAMWEAR"></h2>
              <p class="item-head__desc"><?php echo get_term_by('slug', 'teamwear', 'category')->description; ?></p>
            </div>
          </header>
          
          <div class="item-inner">
            <div class="u-inner u-flex clear">
              
              <!-- // Cloth type -->
              <?php $cat = get_term_by('slug', 'cloth-type', 'category'); ?>
              <article id="<?php echo $cat->slug; ?>" class="item-collection is-col2">
                <h3 class="item-collection__title">クロスタイプ</h3>
                <p class="item-collection__lubi">Cloth type</p>
                <p class="item-collection__desc"><?php echo $cat->description; ?></p>
                <ul class="item-list clear">
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'NV02'), get_permalink(78)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-cross-type1.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Men’s &amp; Women’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'NV02'), get_permalink(84)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-cross-type2.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Boy’s &amp; Girl’s</span></div>
                  </li>
                </ul>
              </article>
              
              <!-- // Windbreaker type -->
              <?php $cat = get_term_by('slug', 'windbreaker-type', 'category'); ?>
              <article id="<?php echo $cat->slug; ?>" class="item-collection is-col2">
                <h3 class="item-collection__title">ウインドブレーカータイプ</h3>
                <p class="item-collection__lubi">Windbreaker type</p>
                <p class="item-collection__desc"><?php echo $cat->description; ?></p>
                <ul class="item-list clear">
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BU03'), get_permalink(90)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-wind-breaker1.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Men’s &amp; Women’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BU03'), get_permalink(108)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-wind-breaker2.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Boy’s &amp; Girl’s</span></div>
                  </li>
                </ul>
              </article>
              
              <!-- // Jersey type -->
              <?php $cat = get_term_by('slug', 'jersey-type', 'category'); ?>
              <article id="<?php echo $cat->slug; ?>" class="item-collection is-col2">
                <h3 class="item-collection__title">ジャージタイプ</h3>
                <p class="item-collection__lubi">Jersey type</p>
                <p class="item-collection__desc"><?php echo $cat->description; ?></p>
                <ul class="item-list clear">
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK12'), get_permalink(126)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-jersey-type1.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Men’s &amp; Women’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'BK12'), get_permalink(132)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-jersey-type2.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Boy’s &amp; Girl’s</span></div>
                  </li>
                </ul>
              </article>
              
              <!-- // T-Shirt -->
              <?php $cat = get_term_by('slug', 't-shirt', 'category'); ?>
              <article id="<?php echo $cat->slug; ?>" class="item-collection is-col2">
                <h3 class="item-collection__title">Tシャツ</h3>
                <p class="item-collection__lubi">T-Shirt</p>
                <p class="item-collection__desc">・・<!-- <?php echo $cat->description; ?> --></p>
                <ul class="item-list clear">
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => 'WH04'), get_permalink(138)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-t-shirt1.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Men’s &amp; Women’s</span></div>
                  </li>
                  <li>
                    <a class="item-list__link" href="<?php echo add_query_arg(array('bcol' => ''), get_permalink(144)); ?>"></a>
                    <div class="item-list__image">
                      <div class="u-center-vertical">
                        <img src="/simulation/assets/images/items/item-t-shirt2.png" alt="ITEM">
                      </div>
                    </div>
                    <div class="item-list__desc"><span>Boy’s &amp; Girl’s</span></div>
                  </li>
                </ul>
              </article>
            </div>
          </div>
        </section>
        <div class="popup popup--system-requirements js-popup">
          <div class="popup-inner">
          <?php get_template_part('template/popup', 'system-requirements'); ?>
          </div>
        </div>
      </article>
    </main>
  </div>

<?php get_footer(); ?>