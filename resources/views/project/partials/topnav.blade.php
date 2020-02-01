<div class="form-inline mr-auto">
  <ul class="navbar-nav mr-3">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg" ><i class="mdi mdi-menu" style="font-size: 24px;"></i></a></li>
  </ul>
  <div class="search-element">
    <div class="input-group">
        <input class="form-control" name="query" type="text" placeholder="{{__('Search')}}" aria-label="Search" data-width="250" autocomplete="off">
        <div class="input-group-append">
            <button class="btn" type="button"><i class="dripicons-search"></i></button>
        </div>
    </div>
  </div>
</div>
<ul class="navbar-nav navbar-right">
  @if(isset($currantWorkspace) && $currantWorkspace && $currantWorkspace->permission == 'Owner')
    @php
      $currantLang = basename(App::getLocale());
    @endphp
  <li class="dropdown dropdown-list-toggle">
    <a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg">
      <span class="align-middle">{{Str::upper($currantLang)}}</span>
      <i class="mdi mdi-chevron-down"></i>
    </a>
    <div class="dropdown-menu dropdown-list dropdown-menu-right">
      @foreach($currantWorkspace->languages() as $lang)
        @if($currantLang != $lang)
        <!-- item-->
          <a href="{{route('project.change_lang_workspace',[$currantWorkspace->id,$lang])}}" class="dropdown-item">
            <span class="align-middle">{{Str::upper($lang)}}</span>
          </a>
        @endif
      @endforeach
      @auth('web')
      <a href="{{route('project.lang_workspace',[$currantWorkspace->slug,$currantWorkspace->lang])}}" class="dropdown-item notify-item">
        <span class="align-middle">{{ __('Create & Customize') }}</span>
      </a>
      @endauth
    </div>
  </li>
  @endif
  <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img @if(Auth::user()->avatar) src="{{asset('/storage/avatars/'.Auth::user()->avatar)}}" @else avatar="{{ Auth::user()->name }}" @endif alt="user-image" class="rounded-circle mr-1">
    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
    <div class="dropdown-menu dropdown-menu-right">
      @foreach(Auth::user()->workspace as $workspace)

          <a href="@if($currantWorkspace->id == $workspace->id)#@else{{ route('project.change_workspace',$workspace->id) }}@endif" title="{{ $workspace->name }}" class="dropdown-item notify-item">
            @if($currantWorkspace->id == $workspace->id)
              <i class="mdi mdi-check"></i>
            @endif
            <span>{{ $workspace->name }}</span>
            @if(isset($workspace->pivot->permission))
              @if($workspace->pivot->permission =='Owner')
                <span class="badge badge-primary">{{$workspace->pivot->permission}}</span>
              @else
                <span class="badge badge-secondary">{{__('Shared')}}</span>
              @endif
            @endif
          </a>
          @if(isset($workspace->pivot->permission))
            @if($workspace->pivot->permission =='Owner')
              <a href="#" data-ajax-popup="true" data-size="lg" data-title="{{ __('Rename Workspace') }}" data-url="{{route('project.rename_workspace',$workspace->id)}}" class="edit-workspace"><i class="mdi mdi-pencil"></i></a>
            @endif
          @endif

      @endforeach
      @if(isset($currantWorkspace) && $currantWorkspace)
        <div class="dropdown-divider"></div>
      @endif
      @auth('web')
        <a href="#" class="dropdown-item notify-item" data-toggle="modal" data-target="#modelCreateWorkspace">
          <i class="mdi mdi-plus"></i>
          <span>{{ __('Create New Workspace')}}</span>
        </a>
      @endauth
      @if(isset($currantWorkspace) && $currantWorkspace)
        @auth('web')
            @if(Auth::user()->id == $currantWorkspace->created_by)
              <a href="#" class="dropdown-item notify-item" onclick="(confirm('Are you sure ?')?document.getElementById('remove-workspace-form').submit(): '');">
                <i class=" mdi mdi-delete-outline"></i>
                <span>{{ __('Remove Me From This Workspace')}}</span>
              </a>
              <form id="remove-workspace-form" action="{{ route('project.delete_workspace', ['id' => $currantWorkspace->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            @else
              <a href="#" class="dropdown-item notify-item" onclick="(confirm('Are you sure ?')?document.getElementById('remove-workspace-form').submit(): '');">
                <i class=" mdi mdi-delete-outline"></i>
                <span>{{ __('Leave Me From This Workspace')}}</span>
              </a>
              <form id="remove-workspace-form" action="{{ route('project.leave_workspace', ['id' => $currantWorkspace->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
              </form>
            @endif
        @endauth
      @endif
          @if(Auth::user()->type == 'user')
        <div class="dropdown-divider"></div>
          @endif
          <a href="@auth('web'){{ route('project.users.my.account') }}@elseauth{{ route('project.client.users.my.account') }}@endauth" class="dropdown-item has-icon">
              <i class="mdi mdi-account-circle mr-1"></i> {{ __('My Account')}}
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
              <i class="mdi mdi-logout mr-1"></i> {{ __('Logout') }}
          </a>

    </div>
  </li>
</ul>
