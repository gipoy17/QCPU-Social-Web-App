<div id="lastPost" data-id="{{ isset($lastPost->id) ? $lastPost->id : ''}}"></div>
@if(count($posts))
    <div id="newsFeed-container" name="{{$posts->getTotal()}}" value="{{$posts->getPerPage()}}">
    <div class="list-group">
        @foreach($posts as $post)
        <div class="list-group-item margin-top-sm">
            <div class="post-header clearfix">
                <a href="#" class="pull-right" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"></i> </a>
                <ul class="dropdown-menu dropdown-menu-right" style="top:25%;" role="menu">
                @if(Auth::user()->StudentID === $post->StudentID)
                    <li><a href="#"><span id="name" data-target="post/edit/{{$post->id}}"><i class="fa fa-edit fa-fw"></i> Edit post</span></a></li>
                    <li class="divider"></li>
                    <li><a id="other" data-target="post/remove/{{$post->id}}"><i class="fa fa-remove fa-fw"></i> Remove post</a></li>
                @else
                    @if(Favorite::user($post->owner->StudentID))
                        <li><a href="#"><span id="unfavorite" data-target="favorites/remove/{{$post->owner->StudentID}}"><i class="fa fa-remove fa-fw"></i> {{$post->owner->Firstname}} to favorite</span></a></li>
                    @else
                        <li><a href="favorites/add/{{$post->owner->StudentID}}"><i class="fa fa-plus fa-fw"></i> {{$post->owner->Firstname}} to favorite</a></li>
                    @endif
                  <li class="divider"></li>
                  <li><a href="#other"><i class="fa fa-file-text fa-fw"></i> Report this post</a></li>
                @endif
                </ul>
                <a href="#postCommentsModal" id="btnPostComment" class="pull-right" data-target="/post/comments/{{$post->id}}"> <small>{{$post->comments->count()}}</small> <i class="fa fa-comments"></i>  </a>
                <a href="post/star/{{$post->id}}" id="btnPostStar" class="pull-right"> <span class="pull-left" id="starCount">{{$post->stars->count()}}</span> &nbsp;<i class="fa {{(Star::checkStar($post->stars)) ? 'fa-star' : 'fa-star-o'}}"></i> <small id="starLabel">{{(Star::checkStar($post->stars)) ? 'Unstar' : 'Star'}}</small></a>
                <img src="{{User::getProfileImage($post->owner->photo)}}" class="img-responsive pull-left post-photo" alt="{{$post->owner->photo}}">
                <span id="name" href="#" data-target="/profile/{{$post->owner->StudentID}}">{{$post->owner->Firstname . ' ' . $post->owner->Lastname}}</span>
                <br/><span class="timeago" data-livestamp="{{strtotime($post->created_at)}}"></span>
                {{($post->edited) ? '<span class="pull-right"><span class="timeago">(edited)</span> <span class="timeago" data-livestamp="'.strtotime($post->updated_at).'"></span></span>' : ''}}
            </div>
            <hr id="fit">
            <div class="post-body">
                {{$post->Message}}
            @if(count($post->photos))
            <div id="statusPhotos" class="margin-top-sm clearfix">
                @foreach($post->photos as $image)
                    <img src="{{$image->image}}" style="{{($post->photos->count() % 2 == 0) ? 'width:50%; height:auto;' : 'width:100%; height:auto;'}}" class="img-responsive pull-left">
                @endforeach
            </div>
            @endif
            </div>
        </div>
        @endforeach
    @else
        <div id="NoMoreStories" class="text-center margin-top-sm">
            <i class="fa fa-meh-o fa-2x"></i>
            <br/> No more stories
        </div>
    @endif
    </div>
</div>

