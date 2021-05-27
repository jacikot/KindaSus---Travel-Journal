<?= $this->include('templates/header_user'); ?>
<script> $(document).ready(function () { $(".regular-badge").popover(); });</script>
    <div class="container-fluid" style="margin-top: -40px;">
        <div class="row">
            <div class="offset-2 col-6">
                <table id="badges">
                    <caption class="text-center" id="caption">
                        My achievements
                    </caption>
                    <?php for ($i = 0; $i < 4; $i++) {
                        ?> <tr> <?php
                        for ($j = 0; $j < 6; $j++) {
                            $badge = $badges[6 * $i + $j];
                            ?>
                                <td>
                                    <img src="<?php
                                        if (isset($badge->user))
                                            echo base_url("assets/images/gold_star_1.png");
                                        else
                                            echo base_url("assets/images/gold_star_2.png"); ?>"
                                         data-original-title="<?= $badge->title ?>"
                                         data-content="<?= $badge->description ?>"
                                         data-placement="top" data-trigger="hover" class="regular-badge">
                                </td>
                        <?php } ?>
                        </tr>
                    <?php } ?>

                </table>
            </div>
            <h2 id="quote" class="col-4 my-auto text-center">“The journey<br> is the reward.”</h2>
        </div>
    </div>
</body>
</html>