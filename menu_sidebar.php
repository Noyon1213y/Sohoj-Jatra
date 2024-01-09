<aside id="sidebar" class="column">

<h3>Bus Route Information</h3>
<ul class="toggle">
<li class="icn_new_article"><a href="bus_info_add.php">Add Bus Route Informationn</a></li>
<li class="icn_edit_article"><a href="bus_info_view.php">View/Edit Route Information</a></li>
</ul>
<h3>Admin</h3>
<ul class="toggle">
<li class="icn_profile"><a href="profile.php">Profile</a></li>
<?php if($_SESSION["user_status"]==1){ ?>
<li class="icn_settings"><a href="settings.php">Settings</a></li><?php } ?>
<li class="icn_jump_back"><a href="logout.php">Logout</a></li>
</ul>
</ul>
<footer>
<hr />
<p><strong>Copyright &copy; 2024 Tech Dueds</strong></p>
</p>
</footer>
	</aside><!-- end of sidebar -->