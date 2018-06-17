<div class="table-responsive list-records">
    <table class="table table-hover table-bordered">
        <thead>
            <!--<th style="width: 10px;"><button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button></th>-->
            <th>#</th>
            <th>ID</th>
            @if(Auth::user()->isAdmin())
            <th>Teacher</th>
            @endif
            <th>Name</th>
            <th>Code</th>
            <th>Enable</th>
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
                        <a href="{{ $editLink }}">{{ $record->id }}</a>
                    @else {{ $record->id }}
                    @endcan
                </td>
                @if(Auth::user()->isAdmin())
                <td>{{$record->Teacher->name}}</td>
                @endif
                <td class="table-text">
                    <a href="{{ $editLink }}">{{ $record->name }}</a>
                </td>
                <td>{{$record->code_invite}}</td>
                <td>{{$record->Status->name}}</td>
                <!-- we will also add show, edit, and delete buttons -->
                <td>
                    <div class="btn-group">
                        @can('viewDetail', $record)
                            <a href="{{ $detailLink }}" class="btn btn-info btn-sm"><i class="fa fa-list"></i></a>
                        @endcan
                        @can('update', $record)
                            <a href="{{ $editLink }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                        @endcan
                        @can('delete', $record)
                            <a href="#" class="btn btn-danger btn-sm btnOpenerModalConfirmModelDelete" data-form-id="{{ $formId }}"><i class="fa fa-trash-o"></i></a>
                        @endcan
                    </div>

                    @can('delete', $record)
                        <!-- Delete Record Form -->
                        <form id="{{ $formId }}" action="{{ $deleteLink }}" method="POST"
                              style="display: none;" class="hidden form-inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endcan
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
