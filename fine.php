<?php
// 定义课程列表
$courses = array(
    "CS101" => "Introduction to Computer Science",
    "MATH101" => "Calculus I",
    "ENGL101" => "Composition I"
);

// 定义学生列表
$students = array(
    "001" => array(
        "name" => "Alice",
        "email" => "alice@example.com",
        "courses" => array()
    ),
    "002" => array(
        "name" => "Bob",
        "email" => "bob@example.com",
        "courses" => array()
    )
);

// 处理表单提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $course_id = $_POST["course_id"];
    
    // 检查学生是否存在
    if (array_key_exists($student_id, $students)) {
        // 检查课程是否存在
        if (array_key_exists($course_id, $courses)) {
            // 检查学生是否已经选择了该课程
            if (!in_array($course_id, $students[$student_id]["courses"])) {
                // 添加课程到学生选课列表中
                $students[$student_id]["courses"][] = $course_id;
                echo "选课成功！";
            } else {
                echo "该课程已经被选择了！";
            }
        } else {
            echo "该课程不存在！";
        }
    } else {
        echo "该学生不存在！";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>选课系统</title>
</head>
<body>
	<h1>选课系统</h1>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="student_id">学生编号：</label>
		<input type="text" name="student_id" required><br>
		<label for="course_id">课程编号：</label>
		<select name="course_id" required>
			<?php foreach ($courses as $id => $name): ?>
				<option value="<?php echo $id ?>"><?php echo $name ?></option>
			<?php endforeach; ?>
		</select><br>
		<input type="submit" value="选课">
	</form>
	<h2>选课情况</h2>
	<table>
		<tr>
			<th>学生编号</th>
			<th>学生姓名</th>
			<th>选课列表</th>
		</tr>
		<?php foreach ($students as $id => $student): ?>
			<tr>
				<td><?php echo $id ?></td>
				<td><?php echo $student["name"] ?></td>
				<td><?php echo implode(", ", $student["courses"]) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>
</html>
