<?php

//show_array($list_users);
?>
<html>
    <head>
        <title>Danh sách thành viên</title>
        <meta charset="utf8"/>
    </head>
    <body>
        <h1>Danh sách thành viên</h1>
        <a href="san-pham-1.html">San Pham</a>
        <table>
            <thead>
                <tr>
                    <td>STT</td>
                    <td>ID</td>
                    <td>UserName</td>
                    <td>Passwork</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list_users)) {
                    $t = 0;
                    foreach ($list_users as $user) {
                        $t ++;
                        ?>
                        <tr>
                            <td><?php echo $t; ?></td>
                            <td><?php echo $user['id'] ?></td>
                            <td><?php echo $user['user_name'] ?></td>
                            <td><?php echo $user['password'] ?></td>
                            <!-- <td><?php echo currency_format($user['earn'], '$'); ?></td> -->
                        </tr>
                        <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </body>
</html>
