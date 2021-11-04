$(document).ready(function () {
  $('#table').DataTable({
    
    'aoColumnDefs': [{
        'sWidth': '20px',
        'aTargets': [0]
      },
      {
        'sWidth': '5%',
        'aTargets': [1]
      },
    {
        'sWidth': '10%',
        'aTargets': [2]
      }

    ],
    aoColumns: [{
        'sWidth': '20%'
      },
      {
        'sWidth': '5%'
      },
      {
        'sWidth': '10%'
      }

    ]
  });


});