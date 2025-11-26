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
      root.innerHTML = `
        <div class="space-y-2">
          <h2 class="text-xl font-semibold">${escapeHtml(data.title)}</h2>
          <p class="text-gray-700">${escapeHtml(data.description)}</p>
        </div>
      `
    } catch (err) {
      root.innerHTML = `<div class="text-sm text-red-500">Failed: ${escapeHtml(err.message)}</div>`
    }
  }

  // small helper
  function escapeHtml (str) {
    return String(str).replace(/[&<>"']/g, (m) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#39;"}[m]))
  }
})
