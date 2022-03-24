
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Отказанная Служебка</h3>
                            <div class="box-tools pull-right">
                                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="mailbox-read-info">
                                <h3><?= $data['tema']; ?></h3>
                                <h5>Кому: <?= $fiokomu; ?> <span class="mailbox-read-time pull-right"><?= date("d.m.Y", strtotime($mail['date'])); ?> в <?= $mail['time']; ?></span></h5>
                            </div><!-- /.mailbox-read-info -->
                            <div class="mailbox-controls with-border text-center">
                                <div class="btn-group">
                                </div><!-- /.btn-group -->
                                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></button>
                            </div><!-- /.mailbox-controls -->
                            <div class="mailbox-read-message">
                                <?= $mail['text_sms']; ?>
                            </div><!-- /.mailbox-read-message -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <ul class="mailbox-attachments clearfix">
                                <?
                                $docs = $mail['files'];

                                $c   = str_word_count($docs); //колличество docs
                                $pieces = explode(" ", $docs);
                                for ($i = 0; $i < $c; $i++) {
                                ?>
                                    <li>
                                        <a href="https://report.aktiv-market.kz/docs/<?= $pieces[$i]; ?>" download=""><span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span></a>
                                        <div class="mailbox-attachment-info">
                                            <a href="https://report.aktiv-market.kz/docs/<?= $pieces[$i]; ?>" class="mailbox-attachment-name" download=""><i class="fa fa-paperclip"></i> <?= $pieces[$i]; ?></a>
                                            <span class="mailbox-attachment-size">
                                                1,245 KB
                                                <a href="https://report.aktiv-market.kz/docs/<?= $pieces[$i]; ?>" download="" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                                            </span>
                                        </div>
                                    </li>
                                <? } ?>
                            </ul>
                        </div><!-- /.box-footer -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <form class="" action="reSend.php" method="post">
                                    <input type="text" hidden="hidden" name="id" value="<?= $id; ?>">
                                    <input type="text" hidden="hidden" name="fioOtkovo" value="<?= $fioOtkovo; ?>">
                                </form>
                            </div>
                        </div><!-- /.box-footer -->
                    </div><!-- /. box -->
         