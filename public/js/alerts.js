
var app = new Vue({

 el: '#app',

 created() {
    this.fetchAlerts();
  },

  data: function() {
    return {
      alerts: [],
      nearBy: [],
    };
  },

  methods: {

     fetchAlerts: function() {
       
       $.getJSON('/alerts', function(res) {
        this.alerts = res
       }.bind(this));

     },
     
     updateAlertList: function(userData)
     {  

        location.reload();
         swal({
            text: "New Distress Call Received",
            title: "SOS",
            type: "info",
        });
     },

     createMap: function() {

       var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 14.583031, lng: 121.063733},
          zoom: 16
        });


     },

     sendAction: function(id)
     {
       $.get('/alerts/'+id+'/edit', function(res) {
          swal({
            text: "Notification Sent",
            title: "SOS",
            type: "success",
        });
         location.reload();
       }.bind(this));

      },

     locateUser: function(user)
     {
        var LatLng = {lat: user.lat, lng: user.lng};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 16,
          center: LatLng
        });

        var marker = new google.maps.Marker({
          position: LatLng,
          map: map,
          title: user.type
        });

        this.getNearby(map,user);
     },

     getNearby: function(map,user)
     {
        var request_type = {
          police: 'police',
          medical: 'hospital',
          rescue : 'rescue',
          fire: 'fire station'
        };

        var request = {
         location: new google.maps.LatLng(user.lat, user.lng),
         radius: '1000',
         //types: [request_type[user.type]],
         keyword: request_type[user.type]
        }

        console.log(request)

       
          $("#places").empty();

          service = new google.maps.places.PlacesService(map);
          service.nearbySearch(request, function(result)
          {
                $.each(result,function(i,r) {
                  service.getDetails({placeId: r.place_id},function(data)
                  {  
                     if(data != null ) {
                      if('formatted_phone_number' in data ){
                        var place = [
                          "<div><strong>"+ data['name'] + "</strong></div>",
                          "<div>"+ data['formatted_address'] +"</div>",
                          "<div>"+ data['formatted_phone_number'] +"</div><hr>",

                        ];
                        $("#places").append(place.join(""));
                     }
                    }
                    
                  });
               })
          }.bind(this) );   
        
       
     }


  },



});