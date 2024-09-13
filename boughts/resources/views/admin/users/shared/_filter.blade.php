
    <div class="float-right" data-toggle="buttons">
        @foreach(trans('users.filters.deletes') as $value => $row)
        <label class="btn btn-{{$row['color']}} btn-sm">
            <input type="radio" name="deletedStatus" class="opacity-0" value="{{$value}}" id="state_{{$value}}" autocomplete="off" data-value="male">
            <span class="livicon" data-name="{{$row['icon']}}" data-size="18" data-loop="true" data-c="#fff"
                  data-hc="white"></span>
        </label>
        @endforeach
    </div>