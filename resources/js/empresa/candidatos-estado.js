function getCsrfToken() {
  const el = document.querySelector('meta[name="csrf-token"]');
  return el ? el.getAttribute('content') : '';
}

document.addEventListener('click', async (e) => {
  const button = e.target.closest('.actualizar-estado');
  if (!button) return;

  const candidatoId = button.dataset.candidatoId;
  const nuevoEstado = button.dataset.estado;

  // oferta_id: lo saco del contenedor cercano (o puedes meterlo directo como data en el botón)
  const ofertaContainer = button.closest('[data-oferta-id]');
  const ofertaId = ofertaContainer ? ofertaContainer.dataset.ofertaId : null;

  try {
    const res = await fetch(`/empresa/candidatos/${candidatoId}/estado`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
        'Accept': 'application/json',
      },
      body: JSON.stringify({ estado: nuevoEstado, oferta_id: ofertaId }),
    });

    // Si viene HTML (por ejemplo redirect a login), esto te ayuda a detectarlo
    const isJson = (res.headers.get('content-type') || '').includes('application/json');
    const data = isJson ? await res.json() : null;

    if (!res.ok || !data?.success) {
      throw new Error(data?.message || 'No se pudo actualizar');
    }

    // Actualiza el texto del estado en la misma fila/celda
    const td = button.closest('td');
    const span = td.querySelector('.estado-texto');
    if (span) span.textContent = nuevoEstado;
  } catch (err) {
    alert('Error al actualizar el estado del candidato.');
    console.error(err);
  }
});
