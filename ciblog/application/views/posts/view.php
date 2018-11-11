<!-- show single post--->
<h2><?php echo $post['title']?></h2>
<small class="post-date">Posted on:<?php echo $post['time']?> </small>
<img class="image-thumb" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image']; ?>">
<div class="post-body"> 
	<?php echo $post['body'];?>
	<hr>
</div>
<!-- edit and delete the post -->
<a href="<?php echo base_url();?>posts/edit/<?php echo $post['slug'];?>" class="btn btn-default pull-left">Edit</a>
<?php echo form_open('/posts/delete/'.$post['id']);?>
<input type="submit" value ="Delete" class="btn btn-danger" />
</form>

<!--its single post so we have to show comments on it-->
<hr>
<h3>Comments</h3>
<?php if($comments) : ?>
	<?php foreach($comments as $comment) : ?>
		<div class= "well">
		<div class="comment-margin">
			<p><?php echo $comment['body']; ?> <br><strong><?php echo $comment['name']; ?></strong></p>
		</div>
		</div>
	<?php endforeach; ?>
<?php else : ?>
	<p>No Comments To Display</p>
<?php endif; ?>

<hr>
<h3>Add Comment</h3>
<?php echo validation_errors(); ?>
<?php echo form_open('comments/create/'.$post['id']); ?>
	<div class="form-group">
		<label>Name</label>
		<input type="text" name="name" class="form-control">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="text" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>Body</label>
		<textarea name="body" class="form-control"></textarea>
	</div>
	<input type="hidden" name="slug" value="<?php echo $post['slug']; ?>">
	<button class="btn btn-primary" type="submit">Submit</button>
</form>


