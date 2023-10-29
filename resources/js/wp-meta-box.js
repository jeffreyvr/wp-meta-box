function wmb_dispatch_event(name, detail) {
    var event = new CustomEvent(name, { detail: detail });
    document.dispatchEvent(event);
}
