<?= App::render('appBundle:includes:header') ?>

    <div class="content-w">
        <div class="content-i">
            <div class="content-box">
                <div class="full-chat-w">
                    <div class="full-chat-i">
                        <div class="full-chat-left">
                            <div class="os-tabs-w">
                                <ul class="nav nav-tabs upper centered">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tab_overview">
                                            <i class="os-icon os-icon-mail-14"></i><span>Chats</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab_sales">
                                            <i class="os-icon os-icon-ui-93"></i><span>Contacts</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="chat-search">
                                <div class="element-search">
                                    <input placeholder="Rechercher un utilisateur ..." type="text">
                                </div>
                            </div>
                            <div class="user-list">
                                <div class="user-w">
                                    <div class="avatar with-status status-green">
                                        <img alt="" src="<?= App::getRessource('appBundle:images:avatar1.jpg') ?>">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-date">12 min</div>
                                        <div class="user-name">John Mayers</div>
                                        <div class="last-message">What is going on, are we...</div>
                                    </div>
                                </div>
                                <div class="user-w">
                                    <div class="avatar with-status status-green">
                                        <img alt="" src="<?= App::getRessource('appBundle:images:avatar2.jpg') ?>">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-date">2 hours</div>
                                        <div class="user-name">Bill Railey</div>
                                        <div class="last-message">Yes, I've sent you details...</div>
                                    </div>
                                </div>
                                <div class="user-w">
                                    <div class="avatar with-status status-green">
                                        <img alt="" src="<?= App::getRessource('appBundle:images:avatar3.jpg') ?>">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-date">24 min</div>
                                        <div class="user-name">Simon Backs</div>
                                        <div class="last-message">What is going on, are we...</div>
                                    </div>
                                </div>
                                <div class="user-w">
                                    <div class="avatar with-status status-green">
                                        <img alt="" src="<?= App::getRessource('appBundle:images:avatar1.jpg') ?>">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-date">7 min</div>
                                        <div class="user-name">Kelley Brooks</div>
                                        <div class="last-message">Can you send me this...</div>
                                    </div>
                                </div>
                                <div class="user-w">
                                    <div class="avatar with-status status-green">
                                        <img alt="" src="<?= App::getRessource('appBundle:images:avatar7.jpg') ?>">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-date">4 hours</div>
                                        <div class="user-name">Vinie Jones</div>
                                        <div class="last-message">What is going on, are we...</div>
                                    </div>
                                </div>
                                <div class="user-w">
                                    <div class="avatar with-status status-green">
                                        <img alt="" src="<?= App::getRessource('appBundle:images:avatar1.jpg') ?>">
                                    </div>
                                    <div class="user-info">
                                        <div class="user-date">2 days</div>
                                        <div class="user-name">Brad Pitt</div>
                                        <div class="last-message">They have submitted users...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="full-chat-middle">
                            <div class="chat-head">
                                <div class="user-info">
                                    <span>Conversation avec</span><a href="#">John Mayers</a>
                                </div>
                                <div class="user-actions">
                                    <a href="#"><i class="os-icon os-icon-mail-07"></i></a>
                                    <a href="#"><i class="os-icon os-icon-phone-15"></i></a>
                                </div>
                            </div>
                            <div class="chat-content-w ps ps--theme_default" data-ps-id="6d86b70d-5afd-6ac2-f88b-aa0612bc5ce5">
                                <div class="chat-content">
                                    <div class="chat-message">
                                        <div class="chat-message-content-w">
                                            <div class="chat-message-content">Hi, my name is Mike, I will be happy to assist you</div>
                                        </div>
                                        <div class="chat-message-avatar"><img alt="" src="<?= App::getRessource('appBundle:images:avatar3.jpg') ?>"></div>
                                        <div class="chat-message-date">9:12am</div>
                                    </div>
                                    <div class="chat-date-separator">
                                        <span>Yesterday</span>
                                    </div>
                                    <div class="chat-message self">
                                        <div class="chat-message-content-w">
                                            <div class="chat-message-content">
                                                That walls over which the drawers. Gone studies to titles have audiences of and concepts was motivator
                                            </div>
                                        </div>
                                        <div class="chat-message-date">
                                            1:23pm
                                        </div>
                                        <div class="chat-message-avatar">
                                            <img alt="" src="<?= App::getRessource('appBundle:images:avatar1.jpg') ?>">
                                        </div>
                                    </div>
                                    <div class="chat-message">
                                        <div class="chat-message-content-w">
                                            <div class="chat-message-content">Slept train nearby a its is design size agreeable. And check cons, but countries the was to such any founding company</div>
                                        </div>
                                        <div class="chat-message-avatar"><img alt="" src="<?= App::getRessource('appBundle:images:avatar3.jpg') ?>"></div>
                                        <div class="chat-message-date">3:45am</div>
                                    </div>
                                </div>
                            </div>
                            <div class="chat-controls">
                                <div class="chat-input">
                                    <input placeholder="Ecrivez votre message ici..." type="text">
                                </div>
                                <div class="chat-input-extra">
                                    <div class="chat-extra-actions">
                                        <a href="#"><i class="os-icon os-icon-mail-07"></i></a>
                                        <a href="#"><i class="os-icon os-icon-phone-15"></i></a>
                                    </div>
                                    <div class="chat-btn">
                                        <a class="btn btn-primary btn-sm" href="#">Répondre</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= App::render('appBundle:includes:footer') ?>