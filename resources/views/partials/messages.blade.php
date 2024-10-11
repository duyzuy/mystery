@if (count($messages))



      
  @foreach ($messages as $message)
      {{-- <div class="alert alert-{{ $message['level'] }}">{!! $message['message'] !!}</div> --}}
      <script>
         
         const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        })

        Toast.fire({
            icon: '{{ $message['level'] }}',
            title: '{!! $message['message'] !!}',
        })
       
    </script>
  @endforeach

@endif


