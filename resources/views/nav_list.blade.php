


<ul class="nav nav-tabs" role="tablist">

    <?php
    $user_id = Session::get('user_id');
    $user_role = \App\User::where('id','=',$user_id)->first()->user_role;
    $role = array();
    if($user_role != 'admin')
    {
      $user_role = explode(',',$user_role);
      for($i=0;$i<sizeof($user_role);$i++)
      {
          echo '


        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="'.$user_role[$i].'" role="tab" aria-controls="home-1" aria-selected="true">'.ucfirst($user_role[$i]).'</a>
          </li>


          ';
      }
    }
    else
    {

       echo'
       <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="admin" role="tab" aria-controls="home-1" aria-selected="true">Admin</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="intaker" ">Inteker</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="scheduler">Scheduler</a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="examiner">Examiner</a>
      </li>
      ';

    }
    ?>



  </ul>




