class Notifier {
    constructor() {
        this.container = null;
        this.notifications = [];
        this.init();
    }

    init() {
        this.container = document.createElement("div");
        this.container.className = "fixed top-5 right-5 space-y-3 z-50";
        document.body.appendChild(this.container);
    }

    show(title, message, type = "info", duration = 5000) {
        const id = Date.now();
        const notification = document.createElement("div");
        notification.innerHTML = `
        <div x-data="{ isVisible: true }" x-init="$nextTick(() => setTimeout(() => isVisible = false, ${duration}))"
          x-show="isVisible" x-transition:enter="transition ease-out duration-300" 
          x-transition:enter-start="translate-y-8 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
          x-transition:leave="transition ease-in duration-300"
          x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 -translate-x-24"
          class="pointer-events-auto relative flex items-center gap-3 rounded-lg border border-${this.getTypeClass(type)} bg-${this.getTypeBackground(type)} text-${this.getTypeClass(type)} p-4 shadow-lg max-w-xs">
          
          <div class="rounded-full bg-${this.getTypeBackground2(type)} bg-opacity-25 p-1 text-${this.getTypeClass(type)}" aria-hidden="true">
            <i class="${this.getTypeIcon(type)}"></i>
          </div>
  
          <div class="flex flex-col gap-1">
            <h3 class="text-sm font-semibold" x-text="'${title}'"></h3>
            <p class="text-sm" x-text="'${message}'"></p>
          </div>
  
          <button type="button" class="ml-auto text-gray-500 hover:text-gray-700" x-on:click="isVisible = false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      `;

        this.container.appendChild(notification);

        setTimeout(() => {
            notification.remove();
        }, duration + 500);
    }
    getTypeClass(type) {
        switch (type) {
            case "success":
                return "green-700";
            case "error":
                return "red-700";
            case "warning":
                return "yellow-700";
            default:
                return "blue-700";
        }
    }
    getTypeBackground2(type) {
        switch (type) {
            case "success":
                return "green-200";
            case "error":
                return "red-200";
            case "warning":
                return "yellow-200";
            default:
                return "blue-200";
        }
    }
    getTypeBackground(type) {
        switch (type) {
            case "success":
                return "green-100";
            case "error":
                return "red-100";
            case "warning":
                return "yellow-100";
            default:
                return "blue-100";
        }
    }
    getTypeIcon(type) {
        switch (type) {
            case "success":
                return "bi bi-check-circle-fill";
            case "error":
                return "bi bi-x-circle-fill";
            case "warning":
                return "bi bi-exclamation-triangle-fill";
            default:
                return "bi bi-info-circle-fill";
        }
    }
}

export default new Notifier();
