# Boosterlab

A child growth monitoring application where parents track monthly weight and height measurements on their Anak. Each monthly reading is a Pengukuran.

## Language

**Anak**:
A child being monitored in the system.
_Avoid_: Child (English), bayi, balita

**Pengukuran**:
A single monthly reading for one Anak, recording weight (berat) and height (tinggi) at a given month number. `bulan = 0` represents birth data (berat_lahir / tinggi_lahir). Each Pengukuran belongs to exactly one Anak.
_Avoid_: DetailAnak, ChildDetail, MeasurementDetail

**PertumbuhanAnak**:
The consolidated concept spanning a child's registration, their monthly growth measurements (weight & height), and the computed growth history. Registration creates both the Anak record and the birth Pengukuran (bulan = 0) in a single operation. Age is a computed property — derived from birth date + current date, never stored.
_Avoid_: GrowthRecord, ChildDetail, AnakDetail

## Example dialogue

**Dev**: "When a parent records a new measurement, does that flow through PertumbuhanAnak?"
**Domain expert**: "Yes — it's one act: the child already exists, and we're adding month 4's weight and height. PertumbuhanAnak handles both the existence check and the recording."
**Dev**: "And the age shown on the dashboard — does PertumbuhanAnak compute that fresh each time?"
**Domain expert**: "It should. We don't want to store a formatted string that goes stale. The child's birth date plus today gives the real age."
