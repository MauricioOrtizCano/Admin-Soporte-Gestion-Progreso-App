import { configureStore } from "@reduxjs/toolkit";
import rootReducer from "./reducer"; // Importa tu rootReducer

const store = configureStore({
  reducer: rootReducer,
});

export default store;
