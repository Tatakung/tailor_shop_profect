<div class="table-responsive">
  <table class="table table-bordered table-hover text-start">
      <thead class="table-dark">
          <tr class="text text-center">
              <th scope="col" class="col-1">Date</th>
              <th scope="col" class="col-3">action</th>

                </tr>
      </thead>

      @foreach ($employee as $end)
          <tr>
              <td>{{$end->created_at}}</td>
              <td>{{$end->new_amount}}</td>
          </tr>
      @endforeach
  </table>
</div>
