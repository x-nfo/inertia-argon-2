import { watch } from 'vue';

export function useStateWatcher(key) {
  watch(
    () => state[key],
    (newValue) => {
      console.log(`${key} changed to: ${newValue}`);
      localStorage.setItem(key, newValue);
    }
  );
}