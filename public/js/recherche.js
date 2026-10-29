const input = document.getElementById('search');
const status = document.getElementById('search-status');
const results = document.getElementById('search-results');

if (input && status && results) {
    let timer;
    let controller;

    input.addEventListener('input', () => {
        clearTimeout(timer);
        controller?.abort();

        const query = input.value.trim();
        results.replaceChildren();

        if (query.length < 2) {
            status.textContent = '';
            return;
        }

        status.textContent = input.dataset.searching;
        timer = setTimeout(async () => {
            controller = new AbortController();
            const url = new URL(input.dataset.searchUrl, window.location.origin);
            url.searchParams.set('q', query);

            try {
                const response = await fetch(url, {
                    headers: { Accept: 'application/json' },
                    signal: controller.signal,
                });

                if (!response.ok) {
                    throw new Error(`Search failed with status ${response.status}`);
                }

                const { data } = await response.json();
                for (const jeu of data) {
                    const item = document.createElement('li');
                    const link = document.createElement('a');
                    link.href = jeu.url;
                    link.textContent = jeu.label;
                    item.append(link);
                    results.append(item);
                }

                status.textContent = data.length
                    ? input.dataset.count.replace(':count', data.length)
                    : input.dataset.empty;
            } catch (error) {
                if (error.name !== 'AbortError') {
                    console.error(error);
                    status.textContent = input.dataset.error;
                }
            }
        }, 200);
    });
}
