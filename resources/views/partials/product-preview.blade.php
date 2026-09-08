<figure class="product-preview {{ $product === 'OkaStore' ? 'preview-store' : '' }}">
    <div class="preview-top">
        <span class="preview-brand">
            <span class="brand-symbol" aria-hidden="true"></span>{{ $product }}</span>
        <span class="preview-label">Vista ilustrativa</span>
    </div>
    <div class="preview-body">
        <div class="preview-heading">
            <div>
                <p>{{ $product === 'OkaStore' ? 'Tu comercio, conectado' : 'Tu operación, conectada' }}</p>
                <h3>{{ $product === 'OkaStore' ? 'Resumen de la tienda' : 'Centro de operaciones' }}</h3>
            </div>
            <span class="preview-avatar" aria-hidden="true">O</span>
        </div>
        <div class="preview-summary">
            <span>
                <i aria-hidden="true">
                </i>{{ $product === 'OkaStore' ? 'Pedidos e inventario' : 'Clientes y servicios' }}</span>
            <span>Una sola plataforma</span>
        </div>
        <div class="preview-table-wrap">
            <table class="preview-table">
                <caption class="sr-only">{{ $product }}: datos ficticios para ilustrar la interfaz</caption>
                <thead>
                    <tr>
                        <th scope="col">{{ $product === 'OkaStore' ? 'Pedido' : 'Cliente' }}</th>
                        <th scope="col">{{ $product === 'OkaStore' ? 'Importe' : 'Plan de internet' }}</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product === 'OkaStore' ? [['Pedido #1042', 'Bs 480,00', 'Pagado'], ['Pedido #1041', 'Bs 1.250,00', 'Enviado'], ['Pedido #1040', 'Bs 96,00', 'Pagado'], ['Pedido #1039', 'Bs 320,00', 'Pendiente']] : [['Cliente de ejemplo A', '120 Mbps', 'Activo'], ['Cliente de ejemplo B', '300 Mbps', 'Activo'], ['Cliente de ejemplo C', '50 Mbps', 'Pendiente'], ['Cliente de ejemplo D', '500 Mbps', 'Activo']] as $row)
                        <tr>
                            <td>{{ $row[0] }}</td>
                            <td>{{ $row[1] }}</td>
                            <td>
                                <span class="status-label {{ $row[2] === 'Pendiente' ? 'status-pending' : '' }}">{{ $row[2] }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="preview-workflow">
            <span>{{ $product === 'OkaStore' ? 'Pedido recibido' : 'Factura emitida' }}</span>
            <span aria-hidden="true">→</span>
            <span>{{ $product === 'OkaStore' ? 'Stock actualizado' : 'Pago registrado' }}</span>
            <span aria-hidden="true">→</span>
            <span>{{ $product === 'OkaStore' ? 'Listo para enviar' : 'Servicio activo' }}</span>
        </div>
    </div>
    <figcaption>Concepto de interfaz · datos de ejemplo</figcaption>
</figure>
