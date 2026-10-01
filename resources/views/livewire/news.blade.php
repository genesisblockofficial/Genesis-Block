<main class="calendar-page">
    <div class="calendar-wrap">
        <span class="calendar-kicker">Genesis Block / Economic Calendar</span>
        <div class="calendar-heading">
            <div>
                <h1>Market calendar</h1>
                <p>Track the economic releases and central-bank events that can move currency markets.</p>
            </div>
            <div class="calendar-live"><span id="calendarClock">Loading market time...</span></div>
        </div>

        <div class="calendar-toolbar" aria-label="Calendar controls">
            <div class="calendar-toolbar-group">
                <button class="calendar-button" id="previousWeek" type="button" aria-label="Previous week">&#8592;</button>
                <button class="calendar-button active" id="todayButton" type="button">Today</button>
                <button class="calendar-button" id="nextWeek" type="button" aria-label="Next week">&#8594;</button>
                <div class="calendar-switcher" role="group" aria-label="Calendar range">
                    <button class="active" data-range="week" type="button">Week</button>
                    <button data-range="day" type="button">Day</button>
                </div>
            </div>
            <div class="calendar-toolbar-group">
                <select class="calendar-select" id="impactFilter" aria-label="Filter by impact">
                    <option value="all">All impact levels</option>
                    <option value="high">High impact</option>
                    <option value="medium">Medium impact</option>
                    <option value="low">Low impact</option>
                </select>
                <select class="calendar-select" id="currencyFilter" aria-label="Filter by currency">
                    <option value="all">All currencies</option>
                    <option value="USD">USD</option><option value="EUR">EUR</option><option value="GBP">GBP</option>
                    <option value="JPY">JPY</option><option value="AUD">AUD</option><option value="CAD">CAD</option>
                </select>
                <select class="calendar-select" id="timezoneSelect" aria-label="Calendar timezone">
                    <option value="local">Local time</option>
                    <option value="UTC">UTC</option>
                </select>
            </div>
        </div>

        <div class="calendar-table" aria-live="polite">
            <div class="calendar-table-head"><span>Time</span><span>Cur.</span><span>Event</span><span>Impact</span><span>Previous</span><span>Forecast</span></div>
            <div id="calendarRows"></div>
        </div>
        <div class="calendar-legend">
            <span><i class="impact-dot high"></i> High impact</span>
            <span><i class="impact-dot medium"></i> Medium impact</span>
            <span><i class="impact-dot low"></i> Low impact</span>
            <span>All times shown in <strong id="timezoneLabel">your local timezone</strong></span>
        </div>
        <div class="calendar-note"><strong>Trading note:</strong> Economic releases are indicative and can be revised. Always confirm the actual result and manage risk around volatile announcements.</div>
    </div>
</main>

<script>
    (() => {
        const sampleEvents = [
            { day: 0, time: '08:30', currency: 'USD', title: 'Initial Jobless Claims', note: 'Weekly labor-market data', impact: 'medium', previous: '228K', forecast: '230K' },
            { day: 0, time: '10:00', currency: 'USD', title: 'Existing Home Sales', note: 'Housing market activity', impact: 'low', previous: '4.00M', forecast: '4.10M' },
            { day: 0, time: '14:00', currency: 'USD', title: 'FOMC Member Speech', note: 'Federal Reserve commentary', impact: 'medium', previous: '-', forecast: '-' },
            { day: 1, time: '02:00', currency: 'GBP', title: 'Retail Sales m/m', note: 'Monthly consumer spending', impact: 'high', previous: '0.3%', forecast: '0.4%' },
            { day: 1, time: '04:30', currency: 'EUR', title: 'ECB Monetary Policy Meeting', note: 'Central bank decision', impact: 'high', previous: '2.15%', forecast: '2.15%' },
            { day: 1, time: '08:30', currency: 'USD', title: 'Building Permits', note: 'Preliminary construction permits', impact: 'medium', previous: '1.45M', forecast: '1.44M' },
            { day: 2, time: '03:30', currency: 'AUD', title: 'Employment Change', note: 'Monthly employment report', impact: 'high', previous: '25.2K', forecast: '18.0K' },
            { day: 2, time: '08:30', currency: 'CAD', title: 'CPI m/m', note: 'Consumer price inflation', impact: 'high', previous: '0.1%', forecast: '0.2%' },
            { day: 2, time: '10:00', currency: 'USD', title: 'New Home Sales', note: 'New residential sales', impact: 'medium', previous: '694K', forecast: '700K' },
            { day: 3, time: '00:30', currency: 'JPY', title: 'National Core CPI y/y', note: 'Core inflation excluding fresh food', impact: 'high', previous: '3.7%', forecast: '3.6%' },
            { day: 3, time: '08:30', currency: 'USD', title: 'Core Durable Goods Orders', note: 'Business investment demand', impact: 'medium', previous: '0.2%', forecast: '0.3%' },
            { day: 3, time: '10:00', currency: 'USD', title: 'Michigan Consumer Sentiment', note: 'Preliminary consumer confidence', impact: 'medium', previous: '60.7', forecast: '61.2' },
            { day: 4, time: '04:00', currency: 'EUR', title: 'German Flash Manufacturing PMI', note: 'Business activity survey', impact: 'medium', previous: '49.0', forecast: '49.5' },
            { day: 4, time: '08:30', currency: 'USD', title: 'GDP Price Index', note: 'Quarterly inflation measure', impact: 'high', previous: '3.4%', forecast: '3.4%' },
            { day: 4, time: '09:45', currency: 'USD', title: 'Chicago PMI', note: 'Regional manufacturing activity', impact: 'low', previous: '40.5', forecast: '42.0' }
        ];
        let events = [];
        const state = { offset: 0, range: 'week', impact: 'all', currency: 'all', timezone: 'local' };
        const rows = document.getElementById('calendarRows');
        const calendarNote = document.querySelector('.calendar-note');
        const dayName = new Intl.DateTimeFormat('en-US', { weekday: 'long' });
        const dateLabel = new Intl.DateTimeFormat('en-US', { month: 'short', day: 'numeric' });

        function monday(date) {
            const copy = new Date(date); copy.setHours(0, 0, 0, 0);
            const day = copy.getDay(); copy.setDate(copy.getDate() - (day === 0 ? 6 : day - 1)); return copy;
        }
        function render() {
            const start = monday(new Date()); start.setDate(start.getDate() + state.offset * 7);
            const days = state.range === 'day' ? [new Date(start)] : Array.from({ length: 5 }, (_, index) => { const day = new Date(start); day.setDate(day.getDate() + index); return day; });
            rows.innerHTML = '';
            days.forEach((day, index) => {
                const dayEvents = events.filter(event => {
                    const eventDate = new Date(`${event.date}T00:00:00`);
                    const dayIndex = Math.round((eventDate - start) / 86400000);

                    return (state.range === 'day' ? dayIndex === 0 : dayIndex === index) &&
                        (state.impact === 'all' || event.impact === state.impact) &&
                        (state.currency === 'all' || event.currency === state.currency);
                });
                const section = document.createElement('section'); section.className = 'calendar-day';
                section.innerHTML = `<div class="calendar-day-title"><strong>${dayName.format(day)} <span>${dateLabel.format(day)}</span></strong><span>${dayEvents.length} event${dayEvents.length === 1 ? '' : 's'}</span></div>`;
                dayEvents.forEach(event => {
                    const item = document.createElement('div'); item.className = 'calendar-event';
                    const dots = ['low', 'medium', 'high'].map(level => `<i class="impact-dot ${level === event.impact ? event.impact : ''}"></i>`).join('');
                    item.innerHTML = `<span class="calendar-time">${event.time}</span><span class="calendar-currency">${event.currency}</span><span class="calendar-event-name">${event.title}<small class="calendar-event-note">${event.note}</small></span><span class="calendar-impact" aria-label="${event.impact} impact">${dots}</span><span class="calendar-number ${event.previous === '-' ? 'muted' : ''}">${event.previous}</span><span class="calendar-number ${event.forecast === '-' ? 'muted' : ''}">${event.forecast}</span>`;
                    section.appendChild(item);
                });
                if (!dayEvents.length) section.insertAdjacentHTML('beforeend', '<div class="calendar-event"><span class="calendar-badge">No matching events for this filter.</span></div>');
                rows.appendChild(section);
            });
        }
        function updateClock() {
            const now = new Date(); const zone = state.timezone === 'UTC' ? 'UTC' : 'local';
            document.getElementById('calendarClock').textContent = `${now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', timeZone: zone === 'UTC' ? 'UTC' : undefined })} ${zone}`;
        }
        async function loadEvents() {
            const start = monday(new Date());
            start.setDate(start.getDate() + state.offset * 7);
            const end = new Date(start);
            end.setDate(end.getDate() + 4);
            const query = new URLSearchParams({
                from: start.toISOString().slice(0, 10),
                to: end.toISOString().slice(0, 10),
            });

            try {
                const response = await fetch(`/api/news/economic-calendar?${query}`);
                const payload = await response.json();

                if (!response.ok) throw new Error(payload.message || 'Unable to load economic events.');

                events = payload.data || [];
                calendarNote.innerHTML = '<strong>Live data:</strong> Events are supplied by Finnhub and may be revised after publication.';
            } catch (error) {
                events = [];
                calendarNote.innerHTML = `<strong>Live data unavailable:</strong> ${error.message} Add a valid <code>FINNHUB_API_KEY</code> to the server environment.`;
            }

            render();
        }
        document.getElementById('previousWeek').addEventListener('click', () => { state.offset--; loadEvents(); });
        document.getElementById('nextWeek').addEventListener('click', () => { state.offset++; loadEvents(); });
        document.getElementById('todayButton').addEventListener('click', () => { state.offset = 0; loadEvents(); });
        document.querySelectorAll('[data-range]').forEach(button => button.addEventListener('click', () => { document.querySelectorAll('[data-range]').forEach(item => item.classList.remove('active')); button.classList.add('active'); state.range = button.dataset.range; render(); }));
        document.getElementById('impactFilter').addEventListener('change', event => { state.impact = event.target.value; render(); });
        document.getElementById('currencyFilter').addEventListener('change', event => { state.currency = event.target.value; render(); });
        document.getElementById('timezoneSelect').addEventListener('change', event => { state.timezone = event.target.value; document.getElementById('timezoneLabel').textContent = event.target.value === 'UTC' ? 'UTC' : 'your local timezone'; updateClock(); });
        loadEvents(); updateClock(); setInterval(updateClock, 30000);
    })();
</script>
