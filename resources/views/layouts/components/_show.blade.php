<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="lead font-weight-bold">{{ $cardHeader }}</span>
                </div>
                
                <div class="row no-gutters">
                    <div class="col-md-4">
                        {{ $image ?? '' }}
                    </div>
                
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="card-title">
                                {{ $cardTitle }}
                            </div>
                            <br>
                            {{ $fields }}
                        </div>
                    </div>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>