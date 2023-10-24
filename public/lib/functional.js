export function compose(arg, ...fns) {
    const h = (fns, arg, i) => i < fns.length ? h(fns, fns[i](arg), i + 1) : arg
    return h(fns, arg, 0)
}
