<div class="page-content">

    <div class="row">
        <div class="col">
            <div class="card radius-10 mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Все тесты</h5>
                        </div>
                        <div class="ms-auto">
                            <a href="/add_test" class="btn btn-primary btn-sm radius-30">Добавить ПЦР тест</a>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tracking ID</th>
                                    <th>barcode</th>
                                    <th>Name</th>
                                    <!-- <th>affiliation</th> -->
                                    <th>result</th>
                                    <th>passport</th>
                                    <th>test_date</th>
                                    <!-- <th>download_date </th> -->
                                    <!-- <th>downloader</th> -->
                                    <th>gender</th>
                                    <th>birthday</th>
                                    <!-- <th>sample_collection </th> -->
                                    <th>result_time </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                foreach ($pcr as $item) : ?>
                                    <tr>
                                        <td>
                                            <a target='_blank' href="/viwe_pdf?id=<?= $item['id'] ?>" class="btn btn-primary"> <?= $item['id'] ?></a>
                                        </td>
                                        <td>

                                            <a href="/Account/PcrTestSonucuDogrula/?barcode=<?= $item['barcode'] ?>" class="btn btn-success">
                                                <?= $item['barcode'] ?></a>

                                        </td>
                                        <td>
                                            <?= $item['lastname'] ?>
                                        </td>
                                        <td>
                                            <?= $item['result'] ?>
                                        </td>
                                        <td><?= $item['passport'] ?></td>
                                        <td>
                                            <?= $item['test_date'] ?>
                                        </td>
                                        <td>
                                            <?= $item['gender'] ?>
                                        </td>
                                        <td>
                                            <?= $item['birthday'] ?>
                                        </td>
                                        <td>
                                            <?= $item['result_time'] ?>
                                        </td>
                                        <td>
                                            <div class="d-flex order-actions"> <a href="/delete_test?id=<?= $item['id'] ?>" class="text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a>
                                                <a href="/edit_test?id=<?= $item['id'] ?>" class="ms-4 text-primary bg-light-primary border-0"><i class='bx bxs-edit'></i></a>
                                                <a href="/viwe_pdf?id=<?= $item['id'] ?>" class="ms-4 text-primary bg-light-primary border-0"><i class='bx bxs-file-pdf'></i></a>

                                            </div>
                                        </td>
                                    </tr>
                                <? endforeach; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>