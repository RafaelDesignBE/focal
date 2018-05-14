<?php foreach ($page as $p): ?>
                <div class="feed__post">
                    <a href="post.php?watch=<?php echo $p['id']; ?>" class="feed__post--image">
                        <figure class="<?php echo $p["photofilter"]; ?>">
                            <img src="<?php echo $p["thmb_url"] ?>">
                        </figure> 
                    </a>
                    <div class="feed__post__info">
                        <div class="feed__post__info--more">
                        <button class="feed__post__info--more--button">More</button>
                            <div class="feed__post__info--more--menu">
                                <div class="flexspace"></div>
                                <div class="feed__post__info--option option__mark" data-post="<?php echo  $p['id']; ?>">Mark as inappropriate</div>
                                <?php if ($_SESSION['user_id'] == Post::getUploader($p['id'])):  ?>
                                    <div class="feed__post__info--option option__delete" data-post="<?php echo  $p['id']; ?>">Delete post</div>
                                <?php endif; ?>
                                <div class="flexspace"></div>
                            </div>
                        </div>
                        <div class="feed__post__info__uploader--container">
                            <?php if (!empty($p['avatar_url'])): ?>
                                <div style="background-image:url(<?php echo $p['avatar_url']; ?>)" class="feed__post__info--avatar"></div>
                            <?php endif; ?>
                            <a href="<?php echo "profile.php?user=".Post::getUploader($p['id']).""; ?>" class="feed__post__info--uploader"><?php echo htmlspecialchars($p['username']); ?></a>
                        </div>
                        <p class="feed__post__info--description"><?php echo htmlspecialchars($p['title']); ?></p>
                        <p class="feed__post__info--uploadtime"><?php echo Post::time_elapsed_string($p['datetime']); ?></p>
                        <?php if(!empty($p['city'])): ?>
                        <div class="post__info--location">
                            <div class="location__icon"></div>
                            <p>
                                <a href="location.php?city=<?php echo htmlspecialchars($p['city']); ?>"><?php echo htmlspecialchars($p['city']); ?></a>, 
                                <a href="location.php?region=<?php echo htmlspecialchars($p['region']); ?>"><?php echo htmlspecialchars($p['region']); ?></a>, 
                                <a href="location.php?country=<?php echo htmlspecialchars($p['country']); ?>"><?php echo htmlspecialchars($p['country']); ?></a>
                            </p>
                        </div>
                        <?php endif; ?>
                        <div class="feed__post__info--reactions">
                            <div class="feed__post__info--likes likes-0"><button class="<?php if( $p['liketype'] === "0" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="0">Like</button><div class="like--count"><?php echo substr_count($p['likes'],"0"); ?></div></div>
                            <div class="feed__post__info--likes likes-1"><button class="<?php if( $p['liketype'] === "1" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="1">Bump</button><div class="like--count"><?php echo substr_count($p['likes'],"1"); ?></div></div>
                            <div class="feed__post__info--likes likes-2"><button class="<?php if( $p['liketype'] === "2" ){ echo "liked liked-db"; } else{echo "like";} ?>" data-post="<?php echo  $p['id']; ?>" data-type="2">Lol</button><div class="like--count"><?php echo substr_count($p['likes'],"2"); ?></div></div>
                        </div>
                        <div class="feed__post__info__comments">
                            <?php 
                                $comments = Post::loadComments($p['id']);
                                foreach ($comments as $c) {
                                    echo "<div class='feed__post__info__comments--comment'>";
                                    echo "<a href='profile.php?user=".$c['id']."' class='feed__post__info__comments--commentUsername'>".htmlspecialchars($c['username'])."</a>";
                                    echo "<p>".htmlspecialchars($c['comment'])."</p>";
                                    echo "</div>";
                                } ?>
            
                        </div>
                        <?php
                                $countComments = Post::countComments($p['id']);
                                if ($countComments > 4) {
                                    echo "<a class='feed__post__info__comments--moreComments' href='post.php?watch=".$p['id']."'>See all <span class='count'>" . $countComments. "</span> comments</a>";
                                }
                            ?>
                        <div class="flexspace"></div>
                        <div class="feed__post__info__add-comment">
                            <textarea class="feed__post__info__add-comment-area" data-post="<?php echo  $p['id']; ?>" data-post="<?php echo  $p['id']; ?>" rows="1" placeholder="Add a comment..."></textarea>
                        </div>
                    </div>
                </div>
                
            <?php endforeach ?>