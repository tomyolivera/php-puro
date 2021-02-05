<?php require_once '../../views/base/head.php'; ?>

<title>Home | FACER</title>

<div class="row">
    <?php
        for ($i=1; $i <= 20; $i++):
            echo "
                    <div class='col col-md-5 mb-5 p-4 bg-gray-900 rounded mr-2'>
                        <h4>Title $i</h4>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, expedita voluptas laudantium odit atque facilis illum sapiente error maiores dolores,
                            quidem eius! Officiis quos laudantium amet mollitia, voluptas quis aut!
                        </p>
                    </div>
            ";
        endfor;
    ?>
</div>

<?php require_once '../../views/base/footer.php'; ?>