<?php

require_once('config.php');
require_once('functions.php');

// DBに接続

$dbh = connectDb();

$tasks = array();

$sql = "select * from tasks where type != 'deleted' order by seq";
foreach ($dbh->query($sql) as $row) {
    array_push($tasks, $row);
}

// var_dump($tasks);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TODOアプリ</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>

    <style>
    .deleteTask, .drag, .editTask {
        cursor: pointer;
        color: blue;
    }
    .done {
        text-decoration: line-through;
        color: grey;
    }
    </style>
</head>
<body>

<h1>TODOアプリ</h1>

<ul id = "tasks">
<?php foreach ($tasks as $task) : ?>
<li id = "task_<?php echo h($task['id']); ?>" data-id = "<?php echo h($task['id']); ?>">

    <!-- チェックボタン -->
    <input type = "checkbox" class = "checkTask" <?php if ($task['type'] == "done") {
        echo "checked"; } ?>>
    <!-- タイトル -->
    <span class = "<?php echo h($task['type']); ?>"><?php echo h($task['title']); ?></span>
    <!-- 編集リンクの作成 -->
    <span <?php if ($task['type'] == "notyet") { echo 'class = "editTask"'; } ?>>[編集]</span>
    <!-- 削除リンクの作成 -->
    <span class = "deleteTask">[削除]</span>
    <!-- ドラッグの作成 -->
    <span class = "drag">[drag]</span>
</li>
<?php endforeach; ?>
</ul>


<script>

$(function() {
    // 編集時の処理
    // 編集ボタンをおした時の処理
    $(document).on('click', '.editTask', function() {
        var id = $(this).parent().data('id');
        var title = $(this).prev().text();
        $('#task_'+id)
        .empty()
        .append($('<input type="text">').attr('value', title))
        .append('<input type="button" value="更新" class="updateTask">');
        $('#task_'+id+' input:eq(0)').focus();
    });
        // 編集フォームの入力後、更新ボタンを押した時の処理
        $(document).on('click', '.updateTask', function() {
            var id = $(this).parent().data('id');
            var title = $(this).prev().val();
            $.post('_ajax_update_task.php', {
                id: id,
                title: title
            }, function(rs) {
                var e = $(
                    '<input type="checkbox" class="checkTask"> ' +
                    '<span></span> ' +
                    '<span class="editTask">[編集]</span> ' +
                    '<span class="deleteTask">[削除]</span> ' +
                    '<span class="drag">[drag]</span>'
                );
                $('#task_'+id).empty().append(e).find('span:eq(0)').text(title);
            });
        });


    // 並び替え時の処理
    $('#tasks').sortable( {
        axis: 'y',
        opacity: 0.2,
        handle: '.drag',
        update: function() {
            $.post('_ajax_sort_task.php', {
                // どの要素のidが何番目に来ているのかを渡す
                task: $(this).sortable('serialize')
            });
        }
    });








    // チェックボタンが押された時の処理
    $(document).on('click', '.checkTask', function() {
        var id = $(this).parent().data('id');
        var title = $(this).next();
        $.post('_ajax_check_task.php', {
            id: id
        }, function(rs) {
            if(title.hasClass('done')) {
                title.removeClass('done').next().addClass('editTask');
            } else {
                title.addClass('done').next().removeClass('editTask');
            }
        });
    });



    // 削除リンクがクリックされた時の処理
    // li要素は動的に入れ替わるためdeleteTaskに直接clickイベントを設定せずにon命令を使う
    $(document).on('click', '.deleteTask', function() {
        if (confirm('本当に削除しますか？')) {
            // this = deleteTaskの親要素であるliのデータ属性のidを引っ張ってくる
            var id = $(this).parent().data('id');
            $.post('_ajax_delete_task.php', {
                id: id
            }, function(rs) {
                $('#task_'+id).fadeOut(800);
            });
        }
    });
});
</script>


</body>
</html>
