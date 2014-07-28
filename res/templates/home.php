<?php include_once 'header.php'; ?>
        <?php if ($this->myTweet !== null): ?>
        <div>
            <h3>My Last Tweet:</h3>

            <?= $this->myTweet->getBody(); ?>
        </div>
        <?php endif; ?>
        <div>
            <form action="<?= $this->urlGenerator->getAbsoluteUrl('tweet/post') ?>" method="post">
                <textarea name="body" placeholder="Tweet..."></textarea>
                <input type="submit" value="Tweet" />
            </form>
        </div>
        <div id="friendTweets"></div>
        </div>
        <script type="text/javascript"><!--
            function getTweets() {
                $.ajax({
                    url: '<?= $this->urlGenerator->getAbsoluteUrl('tweet/following_tweets') ?>',
                    type: 'get',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status === 'not_logged') {
                            window.location = result.data;
                            return;
                        }

                        if (result.data.length === 0) {
                            $('#friendTweets').html('Nothing to show');
                        } else {
                            $('#friendTweets').html('');

                            for (var key in result.data) {
                                var item = result.data[key];

                                $('#friendTweets').append('<div><b>' + item.author + ':</b> ' + item.body +  '</div>')
                            }
                        }
                    }
                });
            }

            getTweets();

            setInterval(getTweets, 2000);
        //--></script>
    </body>
</html>