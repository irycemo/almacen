<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Artículo</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Ubicación</th>
        <th>Origen</th>
        <th>Descripción</th>
        <th>Registrado Por</th>
        <th>Actualizado Por</th>
        <th>Registrado en</th>
        <th>Actualizado en</th>
    </tr>
    </thead>
    <tbody>
    @foreach($entries as $entrie)
        <tr>
            <td>{{ $entrie->id }}</td>
            <td>{{ $entrie->article->name }}</td>
            <td>{{ $entrie->quantity }}</td>
            <td>{{ $entrie->price }}</td>
            <td>{{ $entrie->location }}</td>
            <td>{{ $entrie->origin }}</td>
            <td>{{ $entrie->description }}</td>
            <td>
                @if ($entrie->createdBy)
                    {{ $entrie->createdBy->name }}
                @else
                    N/A
                @endif
            </td>
            <td>
                @if ($entrie->updatedBy)
                    {{ $entrie->updatedBy->name }}
                @else
                    N/A
                @endif
            </td>
            <td>{{ $entrie->created_at }}</td>
            <td>{{ $entrie->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
