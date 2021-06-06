<?= $this->include('templates/header_user'); ?>
<script>
    $(document).ready(function () { $("#badges-table img").popover(); });
</script>
    <div class="container-fluid" style="margin-top: -40px;">
        <div class="row">
            <div class="offset-1 col-7">
                <table id="badges-table">
                    <caption>My achievements</caption>
                    <?php for ($i = 0; $i < 3; $i++) {
                        ?>
                        <tr class="col-md-4 col-lg-12"> <?php
                        for ($j = 0; $j < 5; $j++) {
                            $badge = $badges[5 * $i + $j];
                            ?>
                                <td>
                                    <div>
                                        <img src="<?php
                                        if (isset($badge->user))
                                            echo base_url("assets/images/gold_star_1.png");
                                        else
                                            echo base_url("assets/images/gold_star_2.png"); ?>"
                                             data-original-title="<?= $badge->title ?>"
                                             data-content="<?= $badge->description ?>"
                                             data-placement="top" data-trigger="hover">
                                    </div>
                                </td>
                        <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-4 my-auto">
                <h1 id="quote">“The journey<br> is the reward.”</h1>
            </div>
        </div>
    </div>
</body>
</html>