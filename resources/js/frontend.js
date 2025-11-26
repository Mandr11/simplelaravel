document.addEventListener('DOMContentLoaded', function () {
  const page = document.body.dataset.page || 'index'
  if (page === 'items' || page === 'index') { renderItemsList() }
  if (page === 'show') { renderItemDetail() }

  async function renderItemsList () {
    const root = document.getElementById('app')
    if (!root) return

    root.innerHTML = `
      <header class="mb-4">
        <h2 class="text-xl font-semibold">Items demo</h2>
      </header>

      <div class="mb-4">
        <button id="load" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Load items</button>
      </div>

      <div id="status" class="mb-3 text-sm text-gray-500">No data loaded yet</div>
      <ul id="items" class="space-y-2"></ul>
    `

    const btn = document.getElementById('load')
    const status = document.getElementById('status')
    const itemsEl = document.getElementById('items')

    btn.addEventListener('click', async () => {
      status.textContent = 'Loading...'
      itemsEl.innerHTML = ''

      try {
        const r = await fetch('/api/items')
        if (!r.ok) throw new Error(r.statusText)
        const data = await r.json()

        status.textContent = `Loaded ${data.length} items`;

        data.forEach(item => {
          const li = document.createElement('li')
          li.className = 'p-3 rounded border border-gray-200 flex justify-between items-start gap-3'
          li.innerHTML = `
            <div>
              <strong>${escapeHtml(item.title)}</strong>
              <div class="text-sm text-gray-600">${escapeHtml(item.description)}</div>
            </div>
            <div class="flex items-center gap-2">
              <a class="text-sm text-indigo-600 hover:underline" href="/frontend/items/${item.id}">Open</a>
            </div>
          `
          itemsEl.appendChild(li)
        })
      } catch (err) {
        status.textContent = 'Failed to load data: ' + err.message
      }
    })
  }

  async function renderItemDetail () {
    const root = document.getElementById('app')
    if (!root) return
    const id = root.dataset.id

    root.innerHTML = `<div id="status" class="text-sm text-gray-500">Loading item ${escapeHtml(id)}…</div>`

    try {
      const r = await fetch('/api/items/' + encodeURIComponent(id))
      if (!r.ok) {
        const json = await r.json().catch(() => ({}))
        throw new Error(json.message || r.statusText)
      }

      const data = await r.json()

      // format date nicely
      let created = ''
      try { created = new Date(data.created_at).toLocaleString(); } catch(e) { created = data.created_at || '' }

      // build tags HTML
      const tagsHtml = (data.tags || []).map(t => `<span class="inline-block bg-slate-100 text-slate-700 px-2 py-1 text-xs rounded-full mr-2">${escapeHtml(t)}</span>`).join('')

      root.innerHTML = `
        <div class="grid gap-6 lg:grid-cols-3">
          <div class="lg:col-span-2">
            <div class="rounded-md overflow-hidden mb-4 shadow-sm">
              <img src="${escapeHtml(data.image || '')}" alt="${escapeHtml(data.title)}" class="w-full h-64 object-cover">
            </div>

            <div class="bg-white rounded-lg shadow p-6">
              <div class="flex items-start justify-between gap-4 mb-4">
                <div>
                  <h2 class="text-2xl font-extrabold leading-snug">${escapeHtml(data.title)}</h2>
                  <div class="text-sm text-slate-500">${escapeHtml(data.subtitle || '')}</div>
                  <div class="mt-3 text-sm text-slate-500">By <strong>${escapeHtml(data.author || 'Unknown')}</strong> · ${escapeHtml(created)}</div>
                </div>
                <div class="flex gap-2">
                  <a href="/items/${data.id}/edit" class="px-3 py-1 border rounded text-sm hover:bg-slate-50">Edit</a>
                  <button id="delete-btn" class="px-3 py-1 bg-red-600 text-white rounded text-sm hover:bg-red-700">Delete</button>
                </div>
              </div>

              <div class="mb-4">${tagsHtml}</div>

              <div class="prose max-w-none text-slate-700">${escapeHtml(data.description)}</div>
            </div>

            <div class="mt-4 text-sm text-slate-500">Want to add comments or more actions? This area is a placeholder where you can attach additional panels like attachments or activity logs.</div>
          </div>

          <aside class="bg-white rounded-lg shadow p-4">
            <div class="text-xs text-slate-500 uppercase tracking-wide mb-2">Details</div>
            <dl class="text-sm space-y-2">
              <div><dt class="font-medium">ID</dt><dd class="text-slate-600">${escapeHtml(String(data.id))}</dd></div>
              <div><dt class="font-medium">Author</dt><dd class="text-slate-600">${escapeHtml(data.author || '')}</dd></div>
              <div><dt class="font-medium">Created</dt><dd class="text-slate-600">${escapeHtml(created)}</dd></div>
              <div><dt class="font-medium">Tags</dt><dd class="text-slate-600">${escapeHtml((data.tags || []).join(', '))}</dd></div>
            </dl>

            <div class="mt-4 border-t pt-3">
              <a href="/frontend/items" class="text-sm px-3 py-2 rounded hover:bg-slate-100 inline-block">← Back to items</a>
            </div>
          </aside>
        </div>
      `

      document.getElementById('delete-btn').addEventListener('click', async () => {
        if (!confirm('Are you sure you want to delete this item?')) return

        try {
          const r = await fetch('/api/items/' + encodeURIComponent(id), {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
          })
          if (!r.ok) {
            const json = await r.json().catch(() => ({}))
            throw new Error(json.message || r.statusText)
          }
          window.location.href = '/frontend/items'
        } catch (err) {
          alert('Failed to delete item: ' + err.message)
        }
      })
    } catch (err) {
      root.innerHTML = `<div class="text-sm text-red-500">Failed: ${escapeHtml(err.message)}</div>`
    }
  }

  // small helper
  function escapeHtml (str) {
    return String(str).replace(/[&<>"']/g, (m) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#39;"}[m]))
  }
})
