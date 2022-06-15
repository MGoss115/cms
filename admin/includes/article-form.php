<?php if(!empty($article->errors)): ?>
    <ul>
        <?php foreach($article->errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
 
<form method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Article Title" value="<?= htmlspecialchars($article->title); ?>">>
    </div>
    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" cols="30" rows="10" placeholder="Article Content"><?= htmlspecialchars($article->content); ?></textarea>
    </div>
    <div>
        <label for="published_at">Publication date and time</label>
        <input type="text" name="published_at" id="published_at" value="<?= htmlspecialchars($article->published_at); ?>">
    </div>
    <button type="submit">Save</button>
</form>