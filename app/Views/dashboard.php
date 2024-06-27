            <div class="dash-content">
                <div class="overview">
                    <div class="title">
                        <i class="uil uil-tachometer-fast-alt"></i>
                        <span class="text">Dashboard</span>
                    </div>
                    <div class="boxes">
                        <div class="box box1">
                            <i class="uil uil-thumbs-up"></i>
                            <span class="text">Total Likes</span>
                            <span class="number">50,120</span>
                        </div>
                        <div class="box box2">
                            <i class="uil uil-comments"></i>
                            <span class="text">Comments</span>
                            <span class="number">20,120</span>
                        </div>
                        <div class="box box3">
                            <i class="uil uil-share"></i>
                            <span class="text">Total Share</span>
                            <span class="number">10,120</span>
                        </div>
                    </div>
                </div>

                <div class="activity">
                    <div class="title">
                        <i class="uil uil-clock-three"></i>
                        <span class="text">Recent Activity</span>
                    </div>
                    <?php d($semua) ?>
                    <div class="activity-data">
                        <div class="data names">
                            <span class="data-title">Name</span>
                            <?php foreach ($semua as $i) : ?>
                                <span class="data-list"><?= $i['id_barang']; ?></span>
                            <?php endforeach; ?>
                        </div>
                        <div class="data email">
                            <span class="data-title">Email</span>
                            <span class="data-list">premshahi@gmail.com</span>

                        </div>
                        <div class="data joined">
                            <span class="data-title">Joined</span>
                            <span class="data-list">2022-02-12</span>

                        </div>
                        <div class="data type">
                            <span class="data-title">Type</span>
                            <span class="data-list">New</span>

                        </div>
                        <div class="data status">
                            <span class="data-title">Status</span>
                            <span class="data-list">Liked</span>

                        </div>
                    </div>
                </div>
            </div>
            </section>
            <script src="/js/scripts.js"></script>
            </body>

            </html>