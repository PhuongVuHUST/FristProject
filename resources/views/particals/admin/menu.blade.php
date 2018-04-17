 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('img/default-avatar.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
     
        <li class="active treeview">
            <li class=""> <a href="{{ route('admin.posts.list') }}"> <i class=" fa fa-circle-o">Posts</i></a></li>
            <li class=""> <a href="{{ route('tags.index') }}"> <i class=" fa fa-circle-o">Tags</i></a></li>
            <li class=""> <a href="{{ route('categories.index') }}"> <i class=" fa fa-circle-o">Categories</i></a></li>
            <li class=""> <a href="#"> <i class=" fa fa-circle-o">Users</i></a></li>
        </li>
    
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>