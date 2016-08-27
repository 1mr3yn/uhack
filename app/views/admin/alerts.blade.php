@extends('layouts.admin')
@section('content')
<section class="content-header">
    <h1>
      Emergency Alerts
      <small> </small>
    </h1>
</section>

<section class="content" id="app">
 <div class="row">
      <div class="col-xs-4">
          <div class="box box-danger">
            <div class="box-body table-responsive no-padding">

              <table class="table table-hover">
                <thead>
                 <tr>
                  <th>User</th>
                  <th>Timestamp</th>
                  <th>Type</th>
                  <th>Remarks</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="alert in alerts">
                  <td>@{{alert.user.name}}</td>
                  <td><small> @{{alert.created_at}} </small></td>
                  <td>
                   <a href="#" @click="locateUser(alert)">
                     <span class="btn btn-danger btn-xs">@{{alert.type}}</span>
                    </a>
                  </td>
                  <td><small>@{{alert.remarks}}</small></td>
                  <td>
                   <button class="btn btn-primary btn-xs" v-if="alert.remarks == ''" 
                      @click="sendAction(alert.id)">Acknowledge
                  </button>
                  </td> 
                </tr>
              </tbody>
            </table>
            </div>
          </div>


       </div>

        <div class="col-xs-4">
          <div class="box box-danger">
            <div class="box-body">
               <div id="map"></div>
            </div>
          </div>
        </div>

          <div class="col-xs-4">
          <div class="box box-danger">
            <div class="box-body">
               <div id="places"> <div>
            </div>
          </div>
        </div>

  </div>
</section>

@endsection

@section('scripts')

{{ HTML::script('/js/alerts.js') }}
<script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcCoZ7FPJ1XcNZyipr6O4NKr3FrcO-Okg&callback=app.createMap&libraries=places">
</script>

    <script>

        var pusher = new Pusher('40f9b4a93137b2be762f');
        var notificationsChannel = pusher.subscribe('notification-channel');
        notificationsChannel.bind('notification-event', function(notification){
            var userData = notification.userData;
            app.updateAlertList(userData);
        });

    </script>

@endsection