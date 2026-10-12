const { chromium } = require('C:/Users/aureo/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
const fs = require('fs');
const path = require('path');
const assert = require('assert/strict');

(async () => {
    const browser = await chromium.launch({ headless: true, channel: 'msedge' });
    const results = [];
    try {
        for (const width of [320, 390, 768, 1366]) {
            const context = await browser.newContext({ viewport: { width, height: 844 }, isMobile: width < 768, hasTouch: width < 768 });
            const page = await context.newPage();
            page.setDefaultTimeout(10000);
            const errors = [];
            page.on('pageerror', error => errors.push(error.message));
            await page.route('**/*', async route => {
                const url = new URL(route.request().url());
                if (url.hostname !== 'audit.local') return route.abort();
                const file = url.pathname.startsWith('/build/') || url.pathname.startsWith('/uploads/')
                    ? path.join(process.cwd(), 'public', decodeURIComponent(url.pathname))
                    : path.join(process.cwd(), 'tmp/corrections', path.basename(url.pathname));
                if (!fs.existsSync(file) || !fs.statSync(file).isFile()) return route.abort();
                const type = { '.html': 'text/html; charset=utf-8', '.css': 'text/css', '.js': 'application/javascript', '.png': 'image/png', '.jpg': 'image/jpeg', '.woff2': 'font/woff2' }[path.extname(file)] || 'application/octet-stream';
                await route.fulfill({ body: fs.readFileSync(file), contentType: type });
            });
            for (const name of ['quote', 'contact', 'gallery', 'product', 'privacy']) {
                await page.goto('http://audit.local/' + name + '.html');
                await page.evaluate(() => document.fonts.ready);
                const metrics = await page.evaluate(() => ({ language: document.documentElement.lang, width: innerWidth, scroll: document.documentElement.scrollWidth }));
                assert.equal(metrics.language, 'fr');
                if (metrics.width !== width || metrics.scroll > width + 1) {
                    console.log(name, width, metrics, await page.evaluate(() => [...document.querySelectorAll('body *')].filter(element => element.getBoundingClientRect().right > 321).slice(-12).map(element => ({tag: element.tagName, class: element.className, right: element.getBoundingClientRect().right}))));
                    await page.screenshot({path: 'tmp/corrections/overflow.png', fullPage: true});
                }
                assert.equal(metrics.width, width);
                assert.ok(metrics.scroll <= width + 1, `${name} at ${width}: horizontal overflow ${metrics.scroll}`);
                if (width < 768) {
                    const menu = page.locator('.navbar-toggler');
                    await menu.click();
                    await page.waitForFunction(() => document.querySelector('.navbar-toggler').getAttribute('aria-expanded') === 'true');
                    await page.locator('#navbarNav.show').waitFor({ state: 'visible' });
                }
                if (name === 'product' && width === 1366) {
                    const trigger = page.locator('[data-lightbox-src]').first();
                    await trigger.focus();
                    await page.keyboard.press('Enter');
                    await page.locator('#gallery-lightbox').waitFor({ state: 'visible' });
                    await page.waitForFunction(() => document.activeElement.id === 'gallery-lightbox');
                    await page.keyboard.press('Escape');
                    await page.locator('#gallery-lightbox').waitFor({ state: 'hidden' });
                    await page.waitForFunction(() => document.activeElement.hasAttribute('data-lightbox-src'));
                    assert.ok(await trigger.evaluate(element => element === document.activeElement), 'lightbox focus return');
                }
                if (width === 390) await page.screenshot({ path: `tmp/corrections/${name}-mobile.png`, fullPage: false });
                results.push({ page: name, viewport: width, ...metrics });
                console.log(name, width, 'OK');
            }
            assert.deepEqual(errors, []);
            await context.close();
        }
        fs.writeFileSync('tmp/corrections/browser-results.json', JSON.stringify(results, null, 2));
        console.log('20 renders checked: viewport, language, overflow; mobile menu; keyboard lightbox and focus return.');
    } finally {
        await browser.close();
    }
})().catch(error => { console.error(error.message); process.exitCode = 1; });
