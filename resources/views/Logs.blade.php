@extends('base')

@section('content')
<div class="text-white">
    <header class="p-4" style="
    background-color: #3498db; /* Blue color */
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.4);
    z-index: 1;
    position: fixed;
    width: 100%;
">
    <div class="d-flex justify-content-between align-items-center">
        <div class="text-white">
            <h1 class="p-3" style="
                font-size: 28px;
                color: #fff; /* White text */
            ">
                <i class=""></i> Your Milk Tea Shop
            </h1>
        </div>
        <div class="text-white">
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/dashboard"><i class="fas fa-glass-whiskey"></i>Explore Menu</a>
                    </li>
                    @role('admin')
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/logs"><i class="fas fa-users"></i> View Logs</a>
                    </li>
                    @endrole
                </ul>
            </nav>
        </div>
        <div class="text-white">
            <button
                data-toggle="modal" data-target="#confirmLogoutModal"
                class="btn btn-light rounded-lg pe-4 ps-4">
                <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
            </button>
        </div>
    </div>
</header>


    <div>
        <div class="p-5">
            <div style="margin-top: 100px;">
                {{-- <form method="POST" action="{{ route('logs.clearAll') }}">
                    <h1 class="d-flex justify-content-between">Logs

                            @csrf
                            <button style="text-shadow: 0 0 10px white;" type="submit" class="btn text-white" data-toggle="modal" data-target="#exampleModal">
                                <i class="fa fa-xmark"></i> Clear All Logs
                            </button>

                    </h1>
                </form> --}}
                <br>
                <div class="log-entries">
                    @foreach ($logEntries as $logEntry)
                        <div class="log-entry">
                            <div class="">
                                <i class="fas fa-glass-whiskey"></i>
                            </div>
                            <h5 class="log-entry-title">
                                {{$logEntry->log_entry}}
                            </h5>
                            <div class="log-entry-info">
                                <span class="log-entry-date">Added on {{ $logEntry->created_at->format('M d, Y') }}</span>
                                {{-- Uncomment the form if you want to enable delete functionality --}}
                                {{-- <form method="POST" action="{{ route('log.delete', $logEntry->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
                


            </div>
        </div>
    </div>
</div>
<!-- Confirm Logout -->
<div class="modal fade" style="margin-top: 300px" id="confirmLogoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog text-white" role="document">
      <div class="modal-content" style="background-color: #133bbc">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Logout</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to logout?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Confirm Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<style>
    /* Initial style for the entries */
    .entry {
        transform: translateX(-100%);
        opacity: 0;
        transition: transform 0.5s, opacity 0.5s;
    }

    /* Animation style for the entries when 'animated-page' class is applied */
    .animated-page .entry {
        transform: translateX(0);
        opacity: 1;
    }

    /* Add a transition for the 'animated-page' class to smooth the animation */
    .animated-page .entry {
        transition: transform 0.5s, opacity 0.5s;
    }

    .log-entries {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 30px;
}

.log-entry {
    width: calc(23.33% - 20px); /* Adjust the width as needed */
    background-color: #f0f0f0; /* Light gray background color */
    color: #333; /* Dark gray text color */
    border: 2px solid #ccc; /* Light gray border */
    border-radius: 10px;
    padding: 20px;
    position: relative;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

.icon-container {
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #d9bf77; /* Yellow background color */
    padding: 10px;
    border-radius: 50%;
}

.icon-container i {
    color: #fff; /* White color for the icon */
    font-size: 30px;
}

.log-entry-title {
    color: #333; /* Dark gray header color */
    margin-top: 20px;
}

.log-entry-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.log-entry-date {
    font-size: 12px;
}


/* Customize the delete button as needed */
/* .btn-delete {
    background-color: red;
    color: white;
    border: none;
    border-radius: 50%;
    padding: 5px;
    cursor: pointer;
} */


</style>
<script>
    // Add the 'animated-page' class to the parent container when the page is visited
    document.addEventListener('DOMContentLoaded', function() {
        const pageContainer = document.querySelector('.animated-page');
        pageContainer.classList.add('animated-page');
    });
</script>

@endsection
@auth

@endauth

