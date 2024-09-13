<section class="content">
    <div class="row my-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card {{$type}}">
                    <div class="card-heading">
                        <h3 class="card-title">
                            <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            {{$header}}
                        </h3>
                        <span class="float-right">
                <i class="fa fa-chevron-up clickable"></i>
                <i class="fa fa-remove removepanel clickable"></i>
            </span>
                    </div>
                    <div class="card-body border">
                        {{$slot}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>