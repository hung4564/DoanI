<div class="table-responsive list-records">
  <table class="table table-hover table-bordered">
    <thead>
      <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
      <th>#</th>
      <th>ID</th>
      <th>Name</th>
      <th>Level</th>
      <th>Course</th>
      <th>Status</th>
      <th style="width: 150px;">Actions</th>
    </thead>
    <tbody>
      @foreach ($records as $record)
      <?php
            $tableCounter++;
            $detailLink = route($resourceRoutesAlias.'.detail', $record->id);
            $editLink = route($resourceRoutesAlias.'.edit', $record->id);
            $deleteLink = route($resourceRoutesAlias.'.destroy', $record->id);
            $formId = 'formDeleteModel_'.$record->id;
            ?>
        <tr>
          <!--<td><input type="checkbox" name="ids[]" value="{{ $record->id }}" class="square-blue"></td>-->
          <td>{{ $tableCounter }}</td>
          <td>
            @can('update', $record)
            <a href="{{ $editLink }}">{{ $record->id }}</a> @else {{ $record->id }} @endcan
          </td>
          <td class="table-text">
            <a href="{{ $editLink }}">{{ $record->name }}</a>
          </td>
          <td>
            @if($record->level==0) Easy
            @elseif($record->level==1) Medium
            @else Hard
            @endif
          </td>
          <td>
            @if($record->course_id==0)
            No
            @else
            {{$record->course_id}}
            @endif
          </td>
          @if ($record->status == "1")
          <td><span class="label label-info">Enable</span></td>
          @else
          <td><span class="label label-warning">Disabe</span></td>
          @endif
          <!-- we will also add show, edit, and delete buttons -->
          <td>
            <div class="btn-group">
              @can('viewDetail', $record)
                <a href="{{ $detailLink }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i></a>
              @endcan
              @can('update', $record)
              <a href="{{ $editLink }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a> 
              @endcan
              @can('delete',$record)
              <a href="#" class="btn btn-danger btn-sm btnOpenerModalConfirmModelDelete" data-form-id="{{ $formId }}"><i class="fa fa-trash-o"></i></a> 
              @endcan

            @can('delete', $record)
            <!-- Delete Record Form -->
            <form id="{{ $formId }}" action="{{ $deleteLink }}" method="POST" style="display: none;" class="hidden form-inline">
              {{ csrf_field() }} {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @endcan
          </div>
          </td>

        </tr>
        @endforeach
    </tbody>
  </table>
</div>