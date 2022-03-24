                  <!-- DIRECT CHAT -->
                  <div class="box box-warning direct-chat direct-chat-warning">
                      <div class="box-header with-border">
                          <h3 class="box-title">Рабочий чат</h3>
                          <div class="box-tools pull-right">

                              <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span> -->

                              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                              <button class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments">Чаты</i></button>
                              <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times">X</i></button>
                          </div>
                      </div><!-- /.box-header -->
                      <div class="box-body">
                          <!-- Conversations are loaded here -->
                          <div class="direct-chat-messages">
                              <? foreach ($messages as $message) : ?>
                                  <!-- Message. Default to the left -->
                                  <!-- Message to the right -->
                                  <div class="direct-chat-msg <?= $_SESSION['logged_user']->id == $message['user_id']  ? 'right' : ''; ?> ">
                                      <div class="direct-chat-info clearfix">
                                          <span class="direct-chat-name pull-left"> <?= $message['who'] ?></span>
                                          <span class="direct-chat-timestamp pull-right"><?= $message['time_add'] ?></span>
                                      </div><!-- /.direct-chat-info -->
                                      <img class="direct-chat-img" src="/assets/dist/img/user1-128x128.jpg" alt="message user image"><!-- /.direct-chat-img -->
                                      <div class="direct-chat-text">
                                          <?= $message['text'] ?>
                                      </div><!-- /.direct-chat-text -->
                                  </div><!-- /.direct-chat-msg -->
                              <? endforeach; ?>

                          </div>
                          <!--/.direct-chat-messages-->
                          <input type="text" hidden value="<?= array_pop($messages)['id'] ?>" id="last_id">
                          <!-- Contacts are loaded here -->
                          <div class="direct-chat-contacts">
                              <ul class="contacts-list">
                                  <li>
                                      <a href="#">
                                          <img class="contacts-list-img" src="/assets/dist/img/user1-128x128.jpg">
                                          <div class="contacts-list-info">
                                              <span class="contacts-list-name">
                                                  Общий чат
                                                  <small class="contacts-list-date pull-right">09/01/2022</small>
                                              </span>
                                              <span class="contacts-list-msg">в разработке</span>
                                          </div><!-- /.contacts-list-info -->
                                      </a>
                                  </li><!-- End Contact Item -->

                              </ul><!-- /.contatcts-list -->
                          </div><!-- /.direct-chat-pane -->
                      </div><!-- /.box-body -->
                      <div class="box-footer">
                          <!-- <form action="#" method="post"> -->
                          <div class="input-group">
                              <input type="text" name="message" placeholder="Напишите сообшение ..." class="form-control">
                              <span class="input-group-btn">
                                  <button type="button" class="btn btn-success btn-flat" id="btn-message">Отправить </button>
                              </span>
                          </div>
                          <!-- </form> -->
                      </div><!-- /.box-footer-->
                  </div>
                  <!--/.direct-chat -->
                  </div><!-- /.col -->

                  <script>
                      function dowload_message(mes, last_id) {
                          $.post('add-message', {
                                  text: mes,
                                  last_id: last_id
                              })
                              .done(function(result) {
                                  console.log(result)
                                  let data = JSON.parse(result)
                                  let message_out = '';


                                  if (data.messages) {

                                      data.messages.forEach(element => {

                                          if (element.user_id == data.user_id) {
                                              message_out += `<div class="direct-chat-msg right">`
                                          } else {
                                              message_out += `<div class="direct-chat-msg ">`
                                          }
                                          message_out += `<div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name pull-right"> 
                                                    ${element.who}</span>
                                                    <span class="direct-chat-timestamp pull-left">${element.time_add}</span>
                                                </div>
                                                
                                                <img class="direct-chat-img" src="/assets/dist/img/user3-128x128.jpg" alt="message user image">

                                                <div class="direct-chat-text">
                                                    ${element.text}
                                                </div>
                                            </div>`;
                                      });

                                      $('.direct-chat-messages').append(message_out);
                                      $('#last_id').val(data.last_id);
                                  }
                              })
                      }
                      $('#btn-message').click(function() {
                          let message_text = $('input[name=message]').val();
                          let last_id = $('#last_id').val();
                          if (message_text != '') {
                              dowload_message(message_text, last_id)
                              $('input[name=message]').val('');
                          }
                      });
                      //   setInterval(() => {
                      //       let last_id = $('#last_id').val();
                      //       dowload_message('', last_id)
                      //   }, 1000);
                  </script>