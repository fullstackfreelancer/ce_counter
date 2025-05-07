class CountDownTimer {
    constructor(element) {
        this.element = element;
        this.timestamp = parseInt(this.element.getAttribute('data-time')) * 1000;

        // Parse format: {days,hours} => ['days', 'hours']
        const rawFormat = this.element.getAttribute('data-format') || '';
        this.format = rawFormat.split(',').map(str => str.trim());

        // Parse labels: "Tage,Stunden,Minuten,Sekunden"
        const rawLabels = this.element.getAttribute('data-labels') || '';
        const labelArray = rawLabels.split(',').map(str => str.trim());

        const allUnits = ['d', 'h', 'm', 's'];
        const defaultLabels = ['d', 'h', 'm', 's'];
        this.labels = {};

        allUnits.forEach((unit, index) => {
            this.labels[unit] = labelArray[index] || defaultLabels[index];

            // Hide unused spans
            const span = this.element.querySelector(`.${unit}`);
            if (span && !this.format.includes(unit)) {
                span.style.display = 'none';
            }
        });

        this.interval = null;
    }

    start() {
        this.update();
        this.interval = setInterval(() => this.update(), 1000);
    }

    update() {
        const now = Date.now();
        const remaining = Math.max(0, this.timestamp - now);

        const timeParts = {
            d: Math.floor(remaining / (1000 * 60 * 60 * 24)),
            h: Math.floor((remaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
            m: Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60)),
            s: Math.floor((remaining % (1000 * 60)) / 1000)
        };

        for (const unit of this.format) {

            const element = this.element.querySelector(`.${unit}`);

            if (element) {
                const element_number = element.querySelector('.number');
                const element_label = element.querySelector('.label');
                element_number.textContent = `${timeParts[unit]}`;
                element_label.textContent = `${this.labels[unit]}`;
                element.style.display = ''; // Ensure visible if previously hidden
            }
        }
    }
}
