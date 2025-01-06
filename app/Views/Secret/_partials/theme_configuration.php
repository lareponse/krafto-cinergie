<script>
    let themeAttrs = document.documentElement.dataset;

    for(let attr in themeAttrs) {
        if(localStorage.getItem(attr) != null) {
            document.documentElement.dataset[attr] = localStorage.getItem(attr);

            if (theme === 'auto') {
                document.documentElement.dataset.theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
                    e.matches ? document.documentElement.dataset.theme = 'dark' : document.documentElement.dataset.theme = 'light';
                });
            }
        }
    }
</script>
