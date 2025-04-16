import { CalendarDate } from '@internationalized/date';

export function useDateFormat(date: Date): string {
    const year = date.getFullYear();
    const month = date.getMonth() + 1; // Month is 0-indexed
    const day = date.getDate();

    return new CalendarDate(year, month, day).toString();
}
