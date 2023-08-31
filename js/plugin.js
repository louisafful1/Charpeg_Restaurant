$(document).on('ready', function() {
    // INITIALIZATION OF DATATABLES
    // =======================================================
    HSCore.components.HSDatatables.init($('#datatable'), {

      language: {
        zeroRecords: `<div class="text-center p-4">
            <img class="mb-3" src="./assets/svg/illustrations/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="default">
            <img class="mb-3" src="./assets/svg/illustrations-light/oc-error.svg" alt="Image Description" style="width: 10rem;" data-hs-theme-appearance="dark">
          <p class="mb-0">No data to show</p>
          </div>`
      }
    });

    const datatable = HSCore.components.HSDatatables.getItem('datatable')


    $('#toggleColumn_product').change(function(e) {
      datatable.columns(1).visible(e.target.checked)
    })

    $('#toggleColumn_food').change(function(e) {
      datatable.columns(2).visible(e.target.checked)
    })

    $('#toggleColumn_quantity').change(function(e) {
      datatable.columns(3).visible(e.target.checked)
    })

    $('#toggleColumn_price').change(function(e) {
      datatable.columns(4).visible(e.target.checked)
    })

    $('#toggleColumn_date').change(function(e) {
      datatable.columns(5).visible(e.target.checked)
    })

    $('#toggleColumn_price').change(function(e) {
      datatable.columns(6).visible(e.target.checked)
    })

    datatable.columns(7).visible(false)
    datatable.columns(8).visible(false)



  });