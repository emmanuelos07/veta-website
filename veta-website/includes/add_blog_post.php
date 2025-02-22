<?php
session_start();
include 'db_connection.php';

$title = $_POST['title'];
$content = $_POST['content'];
$author_id = $_SESSION['user']['id'];

$stmt = $conn->prepare("INSERT INTO blog_posts (title, content, author_id) VALUES (:title, :content, :author_id)");
$stmt->execute(['title' => $title, 'content' => $content, 'author_id' => $author_id]);

header("Location: ../pages/manage_blog.php");
exit;