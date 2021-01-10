@extends('layout')

@section('scripts')
    <script>
      function reserve() {
        const currentHref = window.location.href
        const eventId = currentHref.substring(currentHref.lastIndexOf('/') + 1)
        const customerName = $('#customer_name').val();

        let selected = [];
        $('#places input:checked').each(function() {
          selected.push($(this).attr('id'));
        });

        axios.post(`/events/${eventId}`, {
          customer_name: customerName,
          places: selected,
        }).then((response) => {
          const reservationId = response.data.result.reservation_id;

          $('#success-alert')
            .prepend(`<span> Order created successfully. Reservation ID: </span> <strong> ${reservationId} </strong>`)
            .removeClass('fade')
            .addClass('show')

        }).catch((error) => {
          const responseErrorMessages = error.response.data.errors;
          Object.keys(responseErrorMessages).forEach((errorField) => {
            responseErrorMessages[errorField].forEach((e) => {
              $('#danger-alert').prepend(`<span> ${e} </span>`)
            })
          })
          $('#danger-alert').removeClass('fade').addClass('show')
        })
      }

      function removeChildrenNodes(parentNode, node) {
        parentNode.parent().children(node).remove()
      }

      function fadeAlert(parentNode) {
        parentNode.parent().removeClass('show').addClass('fade')
      }


    </script>
@endsection

@section('body')
    <div id="places" class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
        @foreach($places as $id => $place)
                    <input type="checkbox"
                           class="btn-check"
                           id="{{ $id }}"
                           autocomplete="off"
                           @if(!$place['is_available']) disabled @endif
                    >
                    <label
                            class="btn {{ $place['is_available'] ? 'btn-outline-success' : 'btn-danger'}} "
                            for="{{ $id }}"
                            style="
                                    width: {{ $place['width'] }}px;
                                    height: {{ $place['height'] }}px;
                                    left: {{ $place['x'] }}px;
                                    top: {{ $place['y'] }}px;
                                    text-align: center;
                                    position: absolute;
                                   "
                    ></label>
                @endforeach
    </div>

    <div class="input-group mb-1" style="margin-left: 400px">
        <input
                id="customer_name"
                type="text" class="form-control"
                placeholder="Your name"
                aria-label="Your name"
                aria-describedby="basic-addon1"
        >
    </div>

    <button type="button"
            class="btn btn-success"
            style="margin-left: 400px; "
            onclick="reserve()"
    >
        Order
    </button>

    <div id='success-alert' class="alert alert-success fade" role="alert" style="margin-left: 600px">

        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
                onclick="removeChildrenNodes($(this), 'strong'); removeChildrenNodes($(this), 'span'); fadeAlert($(this))"
        >
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div id='danger-alert' class="alert alert-danger fade" role="alert" style="margin-left: 600px">
        <button type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
                onclick="removeChildrenNodes($(this), 'span'); fadeAlert($(this))"
        >
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endsection
