import {
  ERROR,
  GET_USERS,
  GET_SUPPORTCASES,
  GET_COMMENTS,
  CREATE_SUPPORTCASE,
  CREATE_USER_SUPPORTCASE,
  ASSIGN_AGENT,
  UPDATE_CASE_STATUS,
  ADD_COMMENT,
  GET_AGENT,
} from "./actions.js";

const initialState = {
  supportCases: {
    data: [],
    loading: false,
    error: null,
  },
  users: {
    data: {
      data: [],
    },
    loading: false,
    error: null,
  },
  comments: {
    data: [],
    loading: false,
    error: null,
  },
};

export default function rootReducer(state = initialState, { type, payload }) {
  switch (type) {
    case ERROR:
      return {
        ...state,
        error: payload,
      };

    case GET_USERS:
      return {
        ...state,
        users: {
          ...state.users,
          data: payload,
          loading: false,
        },
      };

    case GET_SUPPORTCASES:
      return {
        ...state,
        supportCases: {
          ...state.supportCases,
          data: payload.data,
          loading: false,
        },
      };

    case GET_COMMENTS:
      return {
        ...state,
        comments: {
          ...state.comments,
          data: payload.data,
          loading: false,
        },
      };

    case CREATE_SUPPORTCASE:
      return {
        ...state,
        supportCases: {
          ...state.supportCases,
          data: [...state.supportCases.data, payload.data],
        },
      };

    case CREATE_USER_SUPPORTCASE:
      return {
        ...state,
        users: {
          ...state.users,
          data: [...state.users.data, payload.data],
        },
        supportCases: {
          ...state.supportCases,
          data: [...state.supportCases.data, payload.data],
        },
      };

    case ASSIGN_AGENT:
      return {
        ...state,
        supportCases: {
          ...state.supportCases,
          data: state.supportCases.data.map((caso) =>
            caso.id === payload.data.id ? payload.data : caso
          ),
        },
      };

    case UPDATE_CASE_STATUS:
      return {
        ...state,
        supportCases: {
          ...state.supportCases,
          data: state.supportCases.data.map((caso) =>
            caso.id === payload.data.id ? payload.data : caso
          ),
        },
      };

    case ADD_COMMENT:
      return {
        ...state,
        comments: {
          ...state.comments,
          data: [...state.comments.data, payload.data],
        },
      };

    case GET_AGENT:
      return {
        ...state,
        agent: payload,
      };
    default:
      return { ...state };
  }
}
