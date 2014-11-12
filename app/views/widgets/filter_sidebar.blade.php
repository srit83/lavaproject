<div class="col-md-3 col-sm-12">
    <div class="filter">
        <ul class="nav nav-pills nav-stacked">
            @foreach($all_filters as $filter_name => $curr_filter)
                <li
                @if ($filter == $filter_name)
                    class="active"
                @endif
                ><a href="{{{$curr_filter['route']}}}">{{{$curr_filter['label']}}}
                             <small class="pull-right">{{{$curr_filter['cnt']}}}</small>
                             </a>
                             </li>
            @endforeach

        </ul>
    </div>
</div>