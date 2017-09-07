<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Chatty</a>
    </div>
      
      @if(Auth::check())
         <ul class="nav navbar-nav">
           <li><a href="#">Timeline</a></li>
           <li><a href="#">Friends</a></li>
         </ul>

         <form class="navbar-form navbar-left" role="search" action="#">
           <div class="form-group">
             <input type="text" name="query" class="form-control" placeholder="Find People">
           </div>
           <button class="btn btn-default">Search</button>
         </form>
      @endif
      <ul class="nav navbar-nav navbar-right">

        @if(Auth::check())
          <li><a href="#">Mg Mg</a></li>
          <li><a href="#">Update Profile</a></li>
          <li><a href="#">Sign Out</a></li>
        @else
          <li><a href="#">Sign Up</a></li>
          <li><a href="">Sign In</a></li>
        @endif 
      </ul>
    </div><!-- /.navbar-collapse -->
</nav>